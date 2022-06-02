<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => "Weni Tri Sasmi, S.Pd., M.Pd",
            'email' => 'weni@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567891',
            'nidn' => '1234567891',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Sani Suhardiman. S.Pd., M.Pd.",
            'email' => 'sani@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567892',
            'nidn' => '1234567892',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Yuni Syifau Rohman, S.Pd., M.Pd.",
            'email' => 'yuni@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567893',
            'nidn' => '1234567893',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Lusiana Rahmatiani, S.Pd., M.Pd",
            'email' => 'lusi@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567894',
            'nidn' => '1234567894',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Siti Masruroh, S.Pd., M.Pd",
            'email' => 'sitimasruroh@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567895',
            'nidn' => '1234567895',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Fathurohman, S.Pd., M.T.",
            'email' => 'fathur@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567896',
            'nidn' => '1234567896',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Boyman, S.T., M.T.",
            'email' => 'boyman@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567897',
            'nidn' => '1234567897',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Herdian Kertayasa, S.Pd.I., M.Pd",
            'email' => 'herdian@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567898',
            'nidn' => '1234567898',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Aris Insan Waluya, S.T., M.M",
            'email' => 'aris@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567899',
            'nidn' => '1234567899',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => "Akda Z. W, S.Si., M.Si.",
            'email' => 'akda@gmail.com',
            'password' => Hash::make('dosen123'),
            'slug' => '1234567881',
            'nidn' => '1234567881',
            'role' => 'dosen',
        ]);
        User::factory()->create([
            'name' => ucwords(strtolower('ucup')),
            'email' => 'ucup@gmail.com',
            'password' => Hash::make('mahasiswa123'),
            'slug' => '21416257201080',
            'nim' => '21416257201080',
            'role' => 'mahasiswa',
        ]);
        User::factory()->create([
            'name' => ucwords(strtolower('windah basudara')),
            'email' => 'windah@gmail.com',
            'password' => Hash::make('mahasiswa123'),
            'slug' => '21416257201081',
            'nim' => '21416257201081',
            'role' => 'mahasiswa',
        ]);
        User::factory()->create([
            'name' => ucwords(strtolower('dudung')),
            'email' => 'dudung@gmail.com',
            'password' => Hash::make('mahasiswa123'),
            'slug' => '21416257201082',
            'nim' => '21416257201082',
            'role' => 'mahasiswa',
        ]);
        User::factory()->create([
            'name' => ucwords(strtolower('tarmuji')),
            'email' => 'tarmuji1514@gmail.com',
            'password' => Hash::make('admin123'),
            'slug' => '21416257201084',
            'nim' => '21416257201084',
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => ucwords(strtolower('sobar')),
            'email' => 'sobar@gmail.com',
            'password' => Hash::make('admin123'),
            'slug' => '21416257201085',
            'nim' => '21416257201085',
            'role' => 'admin',
        ]);

        MataKuliah::factory()->create([
            'nama' => "Fisika Dasar (*) Teori",
            'slug' => "TI1190018",
            'kode_mk' => "TI1190018",
            'dosen_pengampu' => 1,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Fisika Dasar (*) Praktikum",
            'slug' => "TI1190018-2",
            'kode_mk' => "TI1190018",
            'dosen_pengampu' => 1,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "English for Engineering",
            'slug' => "TI1190015",
            'kode_mk' => "TI1190015",
            'dosen_pengampu' => 2,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Kalkulus II",
            'slug' => "TI1190019",
            'kode_mk' => "TI1190019",
            'dosen_pengampu' => 3,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Jatidiri Bangsa",
            'slug' => "UBP190005",
            'kode_mk' => "UBP190005",
            'dosen_pengampu' => 4,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Pendidikan Agama",
            'slug' => "UBP190001",
            'kode_mk' => "UBP190001",
            'dosen_pengampu' => 5,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Pendidikan Agama",
            'slug' => "UBP190001-2",
            'kode_mk' => "UBP190001",
            'dosen_pengampu' => 8,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Praktikum Menggambar Teknik",
            'slug' => "TI1190000",
            'kode_mk' => "TI1190000",
            'dosen_pengampu' => 6,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Pengetahuan Lingkungan",
            'slug' => "TI1190017",
            'kode_mk' => "TI1190017",
            'dosen_pengampu' => 7,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Pengantar Ilmu Ekonomi",
            'slug' => "TI1190016",
            'kode_mk' => "TI1190016",
            'dosen_pengampu' => 9,
            'semester' => 2,
        ]);
        MataKuliah::factory()->create([
            'nama' => "Material Teknik",
            'slug' => "TI1190020",
            'kode_mk' => "TI1190020",
            'dosen_pengampu' => 10,
            'semester' => 2,
        ]);

        Jadwal::factory()->create([
            'mata_kuliah_id' => 1,
            'slug' => "jadwal-1",
            'hari' => 1,
            'jam_mulai' => "08:00",
            'jam_selesai' => "10:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 2,
            'slug' => "jadwal-2",
            'hari' => 1,
            'jam_mulai' => "10:00",
            'jam_selesai' => "12:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 3,
            'slug' => "jadwal-3",
            'hari' => 2,
            'jam_mulai' => "08:00",
            'jam_selesai' => "10:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 4,
            'slug' => "jadwal-4",
            'hari' => 2,
            'jam_mulai' => "10:00",
            'jam_selesai' => "12:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 5,
            'slug' => "jadwal-5",
            'hari' => 3,
            'jam_mulai' => "08:00",
            'jam_selesai' => "10:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 6,
            'slug' => "jadwal-6",
            'hari' => 3,
            'jam_mulai' => "10:00",
            'jam_selesai' => "12:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 8,
            'slug' => "jadwal-7",
            'hari' => 4,
            'jam_mulai' => "08:00",
            'jam_selesai' => "10:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 9,
            'slug' => "jadwal-8",
            'hari' => 4,
            'jam_mulai' => "10:00",
            'jam_selesai' => "12:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 7,
            'slug' => "jadwal-9",
            'hari' => 5,
            'jam_mulai' => "14:00",
            'jam_selesai' => "16:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 10,
            'slug' => "jadwal-10",
            'hari' => 6,
            'jam_mulai' => "08:00",
            'jam_selesai' => "10:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 11,
            'slug' => "jadwal-11",
            'hari' => 6,
            'jam_mulai' => "10:00",
            'jam_selesai' => "12:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 8,
            'slug' => "jadwal-12",
            'hari' => 6,
            'jam_mulai' => "16:00",
            'jam_selesai' => "18:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 1,
            'slug' => "jadwal-13",
            'hari' =>1,
            'jam_mulai' => "18:00",
            'jam_selesai' => "20:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 2,
            'slug' => "jadwal-14",
            'hari' =>1,
            'jam_mulai' => "20:00",
            'jam_selesai' => "22:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 3,
            'slug' => "jadwal-15",
            'hari' => 2,
            'jam_mulai' => "18:00",
            'jam_selesai' => "20:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 10,
            'slug' => "jadwal-16",
            'hari' => 3,
            'jam_mulai' => "18:00",
            'jam_selesai' => "20:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 9,
            'slug' => "jadwal-17",
            'hari' => 3,
            'jam_mulai' => "20:00",
            'jam_selesai' => "22:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 4,
            'slug' => "jadwal-18",
            'hari' => 4,
            'jam_mulai' => "18:00",
            'jam_selesai' => "20:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 5,
            'slug' => "jadwal-19",
            'hari' => 4,
            'jam_mulai' => "20:00",
            'jam_selesai' => "22:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 7,
            'slug' => "jadwal-20",
            'hari' => 6,
            'jam_mulai' => "18:00",
            'jam_selesai' => "20:00",
        ]);
        Jadwal::factory()->create([
            'mata_kuliah_id' => 11,
            'slug' => "jadwal-21",
            'hari' => 6,
            'jam_mulai' => "20:00",
            'jam_selesai' => "22:00",
        ]);
    }
}
