<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// routes.php
$route['detail_instansi/(:any)'] = 'Welcome/detail_instansi/$1';
$route['detail_layanan/(:any)'] = 'Welcome/detail_layanan/$1';
$route['detail_layanan_detail/(:any)'] = 'Welcome/detail_layanan_detail/$1';
$route['antrian/masyarakat'] = 'Antrian/index';
$route['blanko'] = 'BlankoPage/index';


// Start AUTH ROUTE
$route['auth/logout'] = 'Login/logout';
$route['auth/login'] = 'Login/index';
$route['auth/register'] = 'Login/register';
$route['auth/goauth/register'] = 'Login/register_proses';
$route['auth/goauth/login'] = 'Login/process_login';
// End AUTH ROUTE

// Start ADMIN ROUTE
$route['admin/dashboard'] = 'ADMIN/Dashboard/index';
$route['admin/instansi'] = 'ADMIN/Instansi/index';
$route['admin/layanan'] = 'ADMIN/Layanan/index';
$route['admin/layanan_detail'] = 'ADMIN/DetailLayanan/index';
$route['admin/berita'] = 'ADMIN/Berita/index';
$route['admin/komentar'] = 'ADMIN/Komentar/index';
$route['admin/syarat'] = 'ADMIN/Syarat/index';
$route['admin/galeri'] = 'ADMIN/Gallery/index';
$route['admin/users'] = 'ADMIN/Users/index';
$route['admin/permohonan'] = 'ADMIN/Permohonan/index';

$route['admin/instansi/tambah'] = 'ADMIN/Instansi/tambah_data_aksi';
$route['admin/instansi/ubah'] = 'ADMIN/Instansi/update_data_aksi';
$route['admin/instansi/delete/(:num)'] = 'ADMIN/Instansi/delete_data_aksi/$1';

$route['admin/komentar/tambah'] = 'ADMIN/Komentar/tambah_data_aksi';
$route['admin/komentar/ubah'] = 'ADMIN/Komentar/update_data_aksi';
$route['admin/komentar/delete/(:num)'] = 'ADMIN/Komentar/delete_data_aksi/$1';

$route['admin/layanan/tambah'] = 'ADMIN/Layanan/tambah_data_aksi';
$route['admin/layanan/ubah'] = 'ADMIN/Layanan/update_data_aksi';
$route['admin/layanan/delete/(:num)'] = 'ADMIN/Layanan/delete_data_aksi/$1';

$route['admin/layanan_detail/tambah'] = 'ADMIN/DetailLayanan/tambah_data_aksi';
$route['admin/layanan_detail/ubah'] = 'ADMIN/DetailLayanan/update_data_aksi';
$route['admin/layanan_detail/delete/(:num)'] = 'ADMIN/DetailLayanan/delete_data_aksi/$1';

$route['admin/berita/tambah'] = 'ADMIN/Berita/tambah_data_aksi';
$route['admin/berita/ubah'] = 'ADMIN/Berita/update_data_aksi';
$route['admin/berita/delete/(:num)'] = 'ADMIN/Berita/delete_data_aksi/$1';

$route['admin/gallery/tambah'] = 'ADMIN/Gallery/tambah_data_aksi';
$route['admin/gallery/ubah'] = 'ADMIN/Gallery/update_data_aksi';
$route['admin/gallery/delete/(:num)'] = 'ADMIN/Gallery/delete_data_aksi/$1';

$route['admin/user/tambah'] = 'ADMIN/Users/tambah_data_aksi';
$route['admin/user/ubah'] = 'ADMIN/Users/update_data_aksi';
$route['admin/user/delete/(:num)'] = 'ADMIN/Users/delete_data_aksi/$1';

$route['admin/permohonan/tambah'] = 'ADMIN/Permohonan/tambah_data_aksi';
$route['admin/permohonan/view/tambah'] = 'ADMIN/Permohonan/tambah_data';
$route['admin/permohonan/ubah'] = 'ADMIN/Permohonan/update_data_aksi';
$route['admin/permohonan/delete/(:num)'] = 'ADMIN/Permohonan/delete_data_aksi/$1';
$route['admin/permohonan/proses/(:num)'] = 'ADMIN/Permohonan/proses_permohonan/$1';
$route['admin/permohonan/tolak'] = 'ADMIN/Permohonan/tolak_permohonan';
$route['admin/permohonan/selesai'] = 'ADMIN/Permohonan/selesai_permohonan';

$route['admin/syarat/tambah'] = 'ADMIN/Syarat/tambah_data_aksi';
$route['admin/syarat/ubah'] = 'ADMIN/Syarat/update_data_aksi';
$route['admin/syarat/delete/(:num)'] = 'ADMIN/Syarat/delete_data_aksi/$1';

$route['admin/berkas/view/tambah'] = 'ADMIN/Berkas/index';
$route['berkas/upload_berkas'] = 'ADMIN/Berkas/upload_berkas';
$route['berkas/remove_file'] = 'ADMIN/Berkas/remove_file';
$route['upload_berkas'] = 'ADMIN/MultiUpload/upload_berkas';
$route['remove_berkas'] = 'ADMIN/MultiUpload/remove_berkas';

$route['admin/permohonan/detail_berkas/(:any)'] = 'ADMIN/Permohonan/detail_berkas/$1';

$route['admin/antrian/daftar'] = 'ADMIN/AntrianAdmin/index';
$route['admin/antrian/selesai/(:num)'] = 'ADMIN/AntrianAdmin/selesai_antrian/$1';

$route['admin/blanko'] = 'ADMIN/Blanko/index';
$route['admin/blanko/tambah'] = 'ADMIN/Blanko/tambah_data_aksi';
$route['admin/blanko/ubah'] = 'ADMIN/Blanko/update_data_aksi';
$route['admin/blanko/delete/(:num)'] = 'ADMIN/Blanko/delete_data_aksi/$1';
// End ADMIN ROUTE

// Start ADMIN ROUTE
$route['petugas/dashboard'] = 'PETUGAS/Dashboard/index';
$route['petugas/instansi'] = 'PETUGAS/Instansi/index';
$route['petugas/layanan'] = 'PETUGAS/Layanan/index';
$route['petugas/layanan_detail'] = 'PETUGAS/DetailLayanan/index';
$route['petugas/berita'] = 'PETUGAS/Berita/index';
$route['petugas/syarat'] = 'PETUGAS/Syarat/index';
$route['petugas/galeri'] = 'PETUGAS/Gallery/index';
$route['petugas/users'] = 'PETUGAS/Users/index';
$route['petugas/permohonan'] = 'PETUGAS/Permohonan/index';

$route['petugas/instansi/tambah'] = 'PETUGAS/Instansi/tambah_data_aksi';
$route['petugas/instansi/ubah'] = 'PETUGAS/Instansi/update_data_aksi';
$route['petugas/instansi/delete/(:num)'] = 'PETUGAS/Instansi/delete_data_aksi/$1';

$route['petugas/komentar/tambah'] = 'PETUGAS/Komentar/tambah_data_aksi';
$route['petugas/komentar/ubah'] = 'PETUGAS/Komentar/update_data_aksi';
$route['petugas/komentar/delete/(:num)'] = 'PETUGAS/Komentar/delete_data_aksi/$1';

$route['petugas/layanan/tambah'] = 'PETUGAS/Layanan/tambah_data_aksi';
$route['petugas/layanan/ubah'] = 'PETUGAS/Layanan/update_data_aksi';
$route['petugas/layanan/delete/(:num)'] = 'PETUGAS/Layanan/delete_data_aksi/$1';

$route['petugas/layanan_detail/ubah'] = 'PETUGAS/DetailLayanan/update_data_aksi';
$route['petugas/layanan_detail/tambah'] = 'PETUGAS/DetailLayanan/tambah_data_aksi';
$route['petugas/layanan_detail/delete/(:num)'] = 'PETUGAS/DetailLayanan/delete_data_aksi/$1';

$route['petugas/berita/tambah'] = 'PETUGAS/Berita/tambah_data_aksi';
$route['petugas/berita/ubah'] = 'PETUGAS/Berita/update_data_aksi';
$route['petugas/berita/delete/(:num)'] = 'PETUGAS/Berita/delete_data_aksi/$1';

$route['petugas/gallery/tambah'] = 'PETUGAS/Gallery/tambah_data_aksi';
$route['petugas/gallery/ubah'] = 'PETUGAS/Gallery/update_data_aksi';
$route['petugas/gallery/delete/(:num)'] = 'PETUGAS/Gallery/delete_data_aksi/$1';

$route['petugas/user/tambah'] = 'PETUGAS/Users/tambah_data_aksi';
$route['petugas/user/ubah'] = 'PETUGAS/Users/update_data_aksi';
$route['petugas/user/delete/(:num)'] = 'PETUGAS/Users/delete_data_aksi/$1';

$route['petugas/permohonan/tambah'] = 'PETUGAS/Permohonan/tambah_data_aksi';
$route['petugas/permohonan/view/tambah'] = 'PETUGAS/Permohonan/tambah_data';
$route['petugas/permohonan/ubah'] = 'PETUGAS/Permohonan/update_data_aksi';
$route['petugas/permohonan/delete/(:num)'] = 'PETUGAS/Permohonan/delete_data_aksi/$1';
$route['petugas/permohonan/proses/(:num)'] = 'PETUGAS/Permohonan/proses_permohonan/$1';
$route['petugas/permohonan/tolak'] = 'PETUGAS/Permohonan/tolak_permohonan';
$route['petugas/permohonan/selesai'] = 'PETUGAS/Permohonan/selesai_permohonan';

$route['petugas/syarat/tambah'] = 'PETUGAS/Syarat/tambah_data_aksi';
$route['petugas/syarat/ubah'] = 'PETUGAS/Syarat/update_data_aksi';
$route['petugas/syarat/delete/(:num)'] = 'PETUGAS/Syarat/delete_data_aksi/$1';

$route['petugas/berkas/view/tambah'] = 'PETUGAS/Berkas/index';
$route['berkas/upload_berkas'] = 'PETUGAS/Berkas/upload_berkas';
$route['berkas/remove_file'] = 'PETUGAS/Berkas/remove_file';
$route['upload_berkas'] = 'PETUGAS/MultiUpload/upload_berkas';
$route['remove_berkas'] = 'PETUGAS/MultiUpload/remove_berkas';

$route['petugas/permohonan/detail_berkas/(:any)'] = 'PETUGAS/Permohonan/detail_berkas/$1';

$route['petugas/antrian/daftar'] = 'PETUGAS/AntrianPetugas/index';
$route['petugas/antrian/selesai/(:num)'] = 'PETUGAS/AntrianPetugas/selesai_antrian/$1';
// End ADMIN ROUTE

// Start USER ROUTE
$route['user/permohonan/tambah'] = 'USER/Permohonan/tambah_data_aksi';
$route['user/komentar/tambah'] = 'USER/Komentar/tambah_data_aksi';
$route['user/komentar'] = 'USER/Komentar/index';

$route['user/dashboard'] = 'USER/Dashboard/index';
$route['user/permohonan'] = 'USER/Permohonan/index';

// End USER ROUTE
