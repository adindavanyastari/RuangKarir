<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckTable extends Command
{
    protected $signature = 'check:table';
    protected $description = 'Check internships table';

    public function handle()
    {
        $this->info('=== CHECKING INTERNSHIPS TABLE ===');
        
        // Cek apakah tabel ada
        if (Schema::hasTable('internships')) {
            $this->info('✅ Table "internships" EXISTS');
            
            // Cek semua kolom
            $columns = Schema::getColumnListing('internships');
            $this->info('📋 Columns found:');
            foreach ($columns as $column) {
                $this->line("   - {$column}");
            }
            
            // Cek khusus kolom is_active
            if (in_array('is_active', $columns)) {
                $this->info('✅ Column "is_active" EXISTS');
            } else {
                $this->error('❌ Column "is_active" NOT FOUND');
            }
            
            // Cek jumlah data
            try {
                $count = DB::table('internships')->count();
                $this->info("📊 Total records: {$count}");
                
                // Cek sample data jika ada
                if ($count > 0) {
                    $sample = DB::table('internships')->first();
                    $this->info('📄 Sample record:');
                    $this->line('   ID: ' . $sample->id);
                    $this->line('   Company: ' . $sample->nama_perusahaan);
                    $this->line('   Position: ' . $sample->posisi_magang);
                }
            } catch (\Exception $e) {
                $this->error('❌ Error accessing table: ' . $e->getMessage());
            }
            
        } else {
            $this->error('❌ Table "internships" does NOT exist');
        }
        
        $this->info('=== CHECK COMPLETE ===');
    }
}