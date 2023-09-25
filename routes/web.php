<?php

use App\Http\Controllers\EmailController;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\DemandeComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DemandesController;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\TermConditionsComponent;
use App\Http\Livewire\User\UserDashboardComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/link', function () {
    Artisan::call('storage:link');
});

Route::get('/send-email',[EmailController::class,'send']);
Route::get('/', HomeComponent::class)->name ('home.index');
//add redirects
Route::get('/redirects',[HomeController::class,"index"]);
//Route::get('/shop', ShopComponent::class)->name ('shop');
Route::get('/product/{slug}/{id}',DetailsComponent::class)->name('product.details')->middleware('auth');
//Route::get('/cart', CartComponent::class)->name ('shop.cart');
//Route::get('/checkout', CheckoutComponent::class)->name ('shop.checkout');
Route::get('/product-category/{slug}',CategoryComponent::class)->middleware('auth')->name('product.category');
Route::get('/search',ShopComponent::class)->name('product.search');
Route::get('/mesDemandes', DemandeComponent::class)->middleware(['auth', 'role:1'])->name ('demande.page');
Route::get('/update-role/{newRole}', [RoleController::class, 'updateRole'])->name('updateRole');
// Route::get('/update-role/{newRole}', [RoleController::class, 'updateRole'])->name('updateRole');
//Route::get('/wishlist',WishlistComponent::class)->name('shop.wishlist');
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//make the annonce offline :
Route::put('/mesAnnonces/{id}/offline' , [AnnonceController::class ,'offline'])->middleware('auth');
Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Show add object Form :
Route::get('/addObject' , [ObjectController::class , 'create'])->middleware(['auth', 'role:1'])->name('objet') ;
//Store the Object Infos :
Route::post('/addObject', [ObjectController::class , 'store'])->middleware(['auth', 'role:1'])->name('object.add');

//show add Annonce Form :
Route::get('/addAnnonce' , [AnnonceController::class , 'create'])->middleware(['auth', 'role:1'])->name('annonce.add') ;
//Store Annonce data :
Route::post('/addAnnonce' , [AnnonceController::class , 'store'])->middleware(['auth', 'role:1']) ;
//diplay All Mes annonce :
Route::get('/mesAnnonces' , [AnnonceController::class , 'index'])->middleware(['auth', 'role:1'])->name('annonces.mesAnnonces') ;
//show annonce :
Route::get('/mesAnnonces/{annonce}' , [AnnonceController::class , 'show'])->middleware(['auth', 'role:1'])->name('annonces.show') ;
//show Update annonce form :
Route::get('/mesAnnonces/{annonce}/edit' , [AnnonceController::class , 'edit'])->middleware(['auth', 'role:1'])->name('annonces.edit') ;
//Updated The annonce :
Route::put('/mesAnnonces/{annonce}' , [AnnonceController::class ,'update'])->middleware(['auth', 'role:1']) ;
//Delete annonce :
Route::delete('/mesAnnonces/{annonce}',[AnnonceController::class , 'destroy'])->middleware(['auth', 'role:1']);
//
//display object:
Route::get('/listeObject' , [ObjectController::class , 'index'])->middleware(['auth', 'role:1'])->name('object.display') ;
Route::delete('/listeObject/{object}', [ObjectController::class, 'destroy'])->middleware(['auth', 'role:1']);
Route::get('/listeObject/{object}/modifierObjet', [ObjectController::class, 'edit'])->middleware(['auth', 'role:1'])->name('objet.edit');
Route::put('/listeObject/{object}', [ObjectController::class, 'update'])->middleware(['auth', 'role:1'])->name('objet.update');
//reclamation partner
Route::get('/Conditions', TermConditionsComponent::class)->name('conditions')->middleware('auth');
Route::get('/Privacy', PrivacyPolicyComponent::class)->name('privacy');
Route::get('/reclamation', [ReclamationController::class, 'create'])->middleware(['auth', 'role:2'])->name('reclamation');
Route::post('/', [ReclamationController::class, 'store'])->middleware('auth');
//admin
Route::post('/admin/banUser/{id}', [AdminController::class, 'banUser'])->name('admin.banUser');
Route::post('/admin/unbanUser/{id}', [AdminController::class, 'unbanUser'])->name('admin.unbanUser');

Route::get('/GestionUser' , [AdminController::class , 'index'])->name('admin.usersList');
// Route::get('/navbarAdmin' , [AdminController::class , 'index1']);

Route::get('/GestionUser/{id}', [AdminController::class, 'viewdetails'])->name('admin.userdetails');
Route::get('/chart' , [\App\Http\Controllers\DashbordchartsController::class , 'index'])->name('admin.chart');
//Gerer Reclamation :
Route::get('/gererReclamations' , [AdminController::class , 'voirRec'])->name('admin.listeReclamations');
//details Reclamation :
Route::get('/gererReclamations/{reclamation}' , [AdminController::class , 'voirRecDetail']);
//Store the Admine response :
Route::post('/gererReclamations/{reclamation}' , [AdminController::class , 'storeRec'])->name('admin.storeRec');
//Store the reservation :
Route::post('/product/{id}', [DemandesController::class ,'store']) ;
Route::get('/GestionCategorie' , [AdminController::class , 'cat'])->name('admin.categories');
//Show add CATEGORY Form :
Route::get('/addCategory' , [CategoryController::class , 'index'])->name('category') ;
//Store the CATEGORY Infos :
Route::post('/addCategory', [CategoryController::class , 'store'])->name('category.add');
Route::get('/GestionAnnonces' , [AdminController::class , 'annonces'])->name('admin.annonces');
Route::delete('deleteAnnonce/{id}' , [AdminController::class , 'delete'])->name('admin.deleteAnnonce');


/////////////////////////////////////////////
Route::middleware(['auth'])->group(function(){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/shop', ShopComponent::class)->name ('shop');
    Route::get('/cart', CartComponent::class)->name ('shop.cart');
    Route::get('/feedback/{demande_id}/{id}', [feedbackController::class, 'create'])->name('feedback.details');
    Route::post('/feedback/add', [feedbackController::class, 'store']);
    Route::get('/wishlist',WishlistComponent::class)->name('shop.wishlist');
});


require __DIR__.'/auth.php';
