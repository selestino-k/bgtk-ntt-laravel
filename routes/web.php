<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserContoller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Slideshow;
use App\Services\ViewCounterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request, ViewCounterService $counter) {
    $counter->record('homepage', $request->ip());

    $slideshowPhotos = Slideshow::where('is_active', true)->orderBy('urutan')->get();
    $documents       = Dokumen::latest()->take(5)->get();

    $latestPosts = Berita::where('published', true)
        ->whereDoesntHave('tags', function ($q) {
            $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
        })
        ->with(['author', 'tags'])
        ->latest()
        ->take(3)
        ->get();

    $pengumuman = Berita::where('published', true)
        ->whereHas('tags', function ($q) {
            $q->whereRaw('LOWER(tagline) = ?', ['pengumuman']);
        })
        ->latest()
        ->take(5)
        ->get();

    return view('home.home', compact('slideshowPhotos', 'latestPosts', 'documents', 'pengumuman'));
})->name('home');

Route::get('/ppid', function () {
    $dokumens = Dokumen::orderBy('created_at', 'desc')->get()->groupBy('kategori');
    return view('home.ppid', compact('dokumens'));
})->name('ppid');

Route::get('/profil/{profile:slug}', [ProfileController::class, 'show'])->name('profil.show');

Route::get('/ult/sarana-prasarana', function () {
    return view('home.sarana');
})->name('ult.sarana-prasarana');

Route::get('/zi-wbk/area-perubahan', function () {
    return view('home.zi-wbk');
})->name('zi-wbk.area-perubahan');

Route::get('/ssd', function () {
    return view('home.ssd');
})->name('ssd');

Route::get('/admin/profil/{profile:slug}', [ProfileController::class, 'show'])->name('profil.show.admin');

Route::view('/login', 'auth.login')->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'username' => 'Username atau password tidak valid.',
    ])->onlyInput('username');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::middleware('auth')->get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/publikasi/pengumuman', [PublicationController::class, 'pengumumanPublic'])->name('pengumuman.index');
Route::get('/publikasi/dokumen', [PublicationController::class, 'dokumenPublic'])->name('dokumen.index');

Route::get('/publikasi/berita-terkini', [PublicationController::class, 'beritaTerkiniPublic'])->name('publikasi.berita.berita');
Route::get('/publikasi/berita-terkini/{berita:slug}', [PublicationController::class, 'beritaTerkiniDetailPublic'])->name('publikasi.berita.show');

Route::middleware('auth')->prefix('admin/publikasi')->name('admin.publikasi.')->group(function () {
    // Berita
    Route::get('/berita', [PublicationController::class, 'beritaIndex'])->name('berita.index');
    Route::get('/berita/create', [PublicationController::class, 'create'])->name('berita.create');
    Route::post('/berita', [PublicationController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita:slug}', [PublicationController::class, 'beritaDetail'])->name('berita.detail');
    Route::get('/berita/{berita:slug}/edit', [PublicationController::class, 'edit'])->name('berita.edit');
    Route::patch('/berita/{berita:slug}', [PublicationController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita:slug}', [PublicationController::class, 'destroy'])->name('berita.destroy');

    // Pengumuman
    Route::get('/pengumuman', [PublicationController::class, 'pengumuman'])->name('pengumuman.index');

    // Dokumen
    Route::get('/dokumen', [PublicationController::class, 'dokumenIndex'])->name('dokumen.index');
    Route::get('/dokumen/create', [PublicationController::class, 'dokumenCreate'])->name('dokumen.create');
    Route::post('/dokumen', [PublicationController::class, 'dokumenStore'])->name('dokumen.store');
    Route::get('/dokumen/{dokumen}/edit', [PublicationController::class, 'dokumenEdit'])->name('dokumen.edit');
    Route::patch('/dokumen/{dokumen}', [PublicationController::class, 'dokumenUpdate'])->name('dokumen.update');
    Route::delete('/dokumen/{dokumen}', [PublicationController::class, 'dokumenDestroy'])->name('dokumen.destroy');

    // Tag
    Route::get('/tag', [PublicationController::class, 'tagIndex'])->name('tag.index');
    Route::get('/tag/create', [PublicationController::class, 'tagCreate'])->name('tag.create');
    Route::post('/tag', [PublicationController::class, 'tagStore'])->name('tag.store');
    Route::get('/tag/{tag}/edit', [PublicationController::class, 'tagEdit'])->name('tag.edit');
    Route::patch('/tag/{tag}', [PublicationController::class, 'tagUpdate'])->name('tag.update');
    Route::delete('/tag/{tag}', [PublicationController::class, 'tagDestroy'])->name('tag.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('profil', ProfileController::class)->except(['show'])->parameters(['profil' => 'profile']);
});

Route::middleware('auth')->prefix('operator')->name('operator.')->group(function () {
    Route::resource('profil', ProfileController::class)->except(['show'])->parameters(['profil' => 'profile']);
});

Route::middleware('auth')->prefix('admin/slideshow')->name('admin.slideshow.')->group(function () {
    Route::get('/', [\App\Http\Controllers\SlideshowController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\SlideshowController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\SlideshowController::class, 'store'])->name('store');
    Route::get('/{slideshow}/edit', [\App\Http\Controllers\SlideshowController::class, 'edit'])->name('edit');
    Route::patch('/{slideshow}', [\App\Http\Controllers\SlideshowController::class, 'update'])->name('update');
    Route::delete('/{slideshow}', [\App\Http\Controllers\SlideshowController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('admin/user')->name('admin.user.')->group(function () {
    Route::get('/', [UserContoller::class, 'index'])->name('index');
    Route::get('/create', [UserContoller::class, 'create'])->name('create');
    Route::post('/', [UserContoller::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserContoller::class, 'edit'])->name('edit');
    Route::patch('/{user}', [UserContoller::class, 'update'])->name('update');
    Route::delete('/{user}', [UserContoller::class, 'destroy'])->name('destroy');
});
