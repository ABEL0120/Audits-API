<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ProductionLine;
use App\Models\Tool;
use App\Models\Employee;
use App\Models\Assignment;
use App\Models\Audit;
use App\Models\AuditItem;
use App\Models\AuditPhoto;
use App\Models\AuditReview;


class AuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Supervisor
        $supervisor = User::create([
            'name' => 'Supervisor Demo',
            'email' => 'sv.ops.8842@example.com',
            'password' => Hash::make('P@zn9$Fk2!Lm5#Qr'),
            'employee_number' => 'SUP8842',
            'role' => 'supervisor',
            'active' => true,
        ]);

        // 2. Técnico
        $technician = User::create([
            'name' => 'Technician Demo',
            'email' => 'tc.field.2291@example.com',
            'password' => Hash::make('Gy7$Wx3!Hb8#Vq2Z'),
            'employee_number' => 'TEC2291',
            'role' => 'technician',
            'active' => true,
        ]);

        // 3. Lineas de Produccion
        $lines = [];
        $lineData = [
            ['code' => 'L001', 'name' => 'Linea de Ensamble A', 'area' => 'Planta Baja'],
            ['code' => 'L002', 'name' => 'Linea de Pintura', 'area' => 'Nave 2'],
            ['code' => 'L003', 'name' => 'Linea de Empaque', 'area' => 'Almacen'],
            ['code' => 'L004', 'name' => 'Linea de Soldadura', 'area' => 'Nave 1'],
            ['code' => 'L005', 'name' => 'Linea de Calidad', 'area' => 'Laboratorio'],
        ];

        foreach ($lineData as $data) {
            $lines[] = ProductionLine::create($data);
        }

        // 4. Herramientas
        $tools = [
            ['code' => 'H001', 'name' => 'Taladro Percutor', 'model' => 'DeWalt DWD520', 'description' => 'Taladro de alto rendimiento', 'line_id' => $lines[0]->id],
            ['code' => 'H002', 'name' => 'Pistola de Pintura', 'model' => 'Sata Jet 5000', 'description' => 'Pistola HVLP para acabados finos', 'line_id' => $lines[1]->id],
            ['code' => 'H003', 'name' => 'Selladora Automatica', 'model' => 'PackMore 3000', 'description' => 'Selladora de cajas de carton', 'line_id' => $lines[2]->id],
            ['code' => 'H004', 'name' => 'Soldadora MIG', 'model' => 'Miller Millermatic 252', 'description' => 'Soldadora para acero al carbon', 'line_id' => $lines[3]->id],
            ['code' => 'H005', 'name' => 'Microscopio Digital', 'model' => 'Leica DMS1000', 'description' => 'Microscopio para inspeccion de calidad', 'line_id' => $lines[4]->id],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        }
    }
}
