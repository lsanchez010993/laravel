<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\Storage;


// Asegúrate de tener importado el modelo Animal


class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $pagina             = $request->query('page', 1);
        $articulosPorPagina = $request->query('posts_per_page', 6);
        $orden              = $request->query('orden', 'nombre_asc');
        $letra              = $request->query('letter');
    
        $query = Animal::query()->orderBy('id', 'desc');
    
        // Filtrar por el usuario autenticado
        if (Auth::check()) {
            $query->where('usuario_id', Auth::id());
        }
    
        if ($orden === 'nombre_asc') {
            $query->orderBy('nombre_comun', 'asc');
        } elseif ($orden === 'nombre_desc') {
            $query->orderBy('nombre_comun', 'desc');
        }
    
        if ($letra) {
            $query->where('nombre_comun', 'like', $letra . '%');
        }
    
        $animales = $query->paginate($articulosPorPagina);
    
        return view('animales.index', compact('animales', 'pagina', 'articulosPorPagina', 'orden', 'letra'));
    }
    

    public function create()
    {
        return view('animales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_comun'      => ['required', 'string', 'max:50'],
            'nombre_cientifico' => ['required', 'string', 'max:50'],
            'descripcion'       => ['required', 'string'],
            'imagen'            => ['nullable', 'image', 'max:2048'],
            'es_mamifero'       => ['required', 'boolean'],
        ]);
    
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '.' . $file->getClientOriginalExtension();
    
            // 1. Mover el archivo directamente a public/images/animales
            $file->move(public_path('images/animales'), $nombreArchivo);
    
            // 2. Guardar en BD la ruta relativa, para luego usarla con asset()
            $rutaImagen = 'images/animales/' . $nombreArchivo;
        }
    
        Animal::create([
            'nombre_comun'      => $request->input('nombre_comun'),
            'nombre_cientifico' => $request->input('nombre_cientifico'),
            'descripcion'       => $request->input('descripcion'),
            'ruta_imagen'       => $rutaImagen,
            'es_mamifero'       => $request->input('es_mamifero'),
            'usuario_id'        => Auth::user()->id, 
            'publicado'         => 1,
        ]);
    
        return redirect()->route('animales.index')->with('success', '¡Animal creado correctamente!');
    }
    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        return view('animales.edit', compact('animal'));
    }


    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        // Validar los datos
        $validatedData = $request->validate([
            'nombre_comun' => 'required|string|max:255',
            'nombre_cientifico' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048', // máximo 2MB
            'es_mamifero' => 'required|boolean',
        ]);

        // Si se ha cargado una nueva imagen, procesarla y actualizar la ruta
        if ($request->hasFile('imagen')) {
            // Si el animal ya tiene imagen, opcionalmente se puede eliminar la imagen antigua:
            if ($animal->ruta_imagen && Storage::disk('public')->exists($animal->ruta_imagen)) {
                Storage::disk('public')->delete($animal->ruta_imagen);
            }
            $imagePath = $request->file('imagen')->store('animales', 'public');
            $validatedData['ruta_imagen'] = $imagePath;
        }

        // Actualizar el animal con los datos validados
        $animal->update($validatedData);

        return redirect()->route('animales.index')->with('success', 'Animal actualizado correctamente.');
    }
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);

        // Verificar que el usuario autenticado es el dueño del animal
        if (Auth::check() && $animal->usuario_id == Auth::id()) {
            // Si el animal tiene una imagen y existe en el almacenamiento público, eliminarla
            if ($animal->ruta_imagen && Storage::disk('public')->exists($animal->ruta_imagen)) {
                Storage::disk('public')->delete($animal->ruta_imagen);
            }

            $animal->delete();

            return redirect()->route('animales.index')->with('success', 'Animal eliminado correctamente.');
        }

        return redirect()->route('animales.index')->withErrors(['error' => 'No tienes permisos para eliminar este animal.']);
    }
}
