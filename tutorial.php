Berikut adalah panduan lengkap cara menggunakan sistem hak akses (role) dinamis yang telah kita definisikan di dalam aplikasi Anda.1. Di dalam File BladeUntuk mengontrol tampilan elemen HTML berdasarkan hak akses pengguna. Gunakan direktif @can dan @endcan.Skenario: Menampilkan tombol "Hapus" hanya jika user memiliki izin untuk mengakses item tersebut.<!-- Di dalam loop, misalnya di livewire/employee/table.blade.php -->

@foreach ($employees as $employee)
    <tr>
        <!-- ... data lainnya ... -->
        <td>
            <!-- Periksa izin sebelum menampilkan tombol -->
            @can('access-unit-item', $employee)
                <button wire:click="delete({{ $employee->id }})">
                    Hapus
                </button>
            @endcan
        </td>
    </tr>
@endforeach
Contoh lain: Menampilkan menu navigasi khusus admin.<!-- di file resources/views/navigation-menu.blade.php -->

@can('has-role', 'admin')
    <x-nav-link href="{{ route('admin.dashboard') }}">
        Dashboard Admin
    </x-nav-link>
@endcan
2. Di dalam ControllerUntuk melindungi seluruh metode atau aksi dari akses yang tidak sah. Gunakan metode $this->authorize(). Jika gagal, Laravel akan otomatis menampilkan halaman error 403 (Forbidden).Skenario: Melindungi halaman edit agar tidak bisa diakses melalui URL secara langsung oleh user yang tidak berwenang.// di file app/Http/Controllers/EmployeeController.php

use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmployeeController extends Controller
{
    use AuthorizesRequests; // Pastikan Trait ini digunakan

    public function edit(Employee $employee): View
    {
        // Baris ini akan menghentikan eksekusi jika user tidak punya izin
        // untuk mengakses data $employee yang spesifik.
        $this->authorize('access-unit-item', $employee);

        // Jika lolos, tampilkan halaman.
        return view('employees.edit', compact('employee'));
    }
}
3. Di dalam Komponen LivewireUntuk melindungi aksi (seperti delete, approve, dll.) yang dipicu dari halaman. Gunakan Gate::denies() atau Gate::allows(). Ini penting sebagai lapisan keamanan kedua setelah menyembunyikan tombol di Blade.Skenario: Memastikan aksi delete di dalam komponen tabel benar-benar memeriksa hak akses sebelum menghapus data.// di file app/Livewire/Employee/Table.php

use Illuminate\Support\Facades\Gate;

class Table extends Component
{
    // ...

    public function delete(Employee $employee)
    {
        // Periksa izin menggunakan Gate.
        // `denies` akan bernilai true jika user TIDAK diizinkan.
        if (Gate::denies('access-unit-item', $employee)) {
            // Beri pesan error dan hentikan aksi.
            session()->flash('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            return;
        }

        // Jika diizinkan, lanjutkan proses hapus.
        $employee->delete();
        session()->flash('success', 'Data berhasil dihapus.');
    }
    
    // ...
}
4. Di dalam File RoutesUntuk melindungi seluruh halaman atau grup halaman dari akses. Gunakan middleware can.Skenario: Membuat grup rute yang hanya dapat diakses oleh user dengan role sistem admin.// di file routes/web.php

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AuditLogController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:has-role,admin' // Middleware untuk memeriksa role 'admin'
])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute ini hanya bisa diakses oleh admin: /admin/settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // Rute ini juga hanya bisa diakses oleh admin: /admin/logs
    Route::get('/logs', [AuditLogController::class, 'index'])->name('logs');

});
