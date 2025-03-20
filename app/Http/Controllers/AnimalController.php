<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

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
    
}
