<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super',
                'description' => 'SUPER USUÁRIO'
            ],
            [
                'name' => 'admin',
                'description' => 'Administrador'
            ],
            [
                'name' => 'user',
                'description' => 'USUÁRIO COMUM'
            ],
            [
                'name' => 'teachers',
                'description' => 'Professor'
            ],
            [
                'name' => 'coordinators',
                'description' => 'Coordenador'
            ],
            [
                'name' => 'students',
                'description' => 'Aluno'
            ],
            [
                'name' => 'technician',
                'description' => 'Técnico'
            ],
            [
                'name' => 'management',
                'description' => 'Gerente'
            ],
            [
                'name' => 'direction',
                'description' => 'Direção'
            ],
            [
                'name' => 'assessor',
                'description' => 'Assessor Pedagógico'
            ],
            [
                'name' => 'edicao_de_texto_e_imagem',
                'description' => 'Edição de Texto e Imagem'
            ],
            [
                'name' => 'ilustracao',
                'description' => 'Ilustração'
            ],
            [
                'name' => 'producao_desenho',
                'description' => 'Produção - Desenho'
            ],
            [
                'name' => 'producao_de_conteudo',
                'description' => 'Produção de Contéudo'
            ],
            [
                'name' => 'producao_externa_e_edicao_final',
                'description' => 'Produção Externa e Edição Final'
            ],
            [
                'name' => 'revisao_traducao',
                'description' => 'Revisão/Tradução'
            ],
            [
                'name' => 'roteiro',
                'description' => 'Roteiro'
            ],
            [
                'name' => 'transmissora',
                'description' => 'Transmissora'
            ],
            [
                'name' => 'edicao_de_finalizacao',
                'description' => 'Edição de Finalização'
            ],
            [
                'name' => 'producao_externa',
                'description' => 'Produção Externa'
            ],
            [
                'name' => 'gemcd',
                'description' => 'GEMCD'
            ],
            [
                'name' => 'equipe_pedagógica',
                'description' => 'Equipe Pedagógica'
            ],
            [
                'name' => 'assessores_da_diretoria',
                'description' => 'Assessores da Diretoria'
            ],
            [
                'name' => 'gerente_de_midias_e_conteudos_digitais',
                'description' => 'Gerente de Mídias e Conteúdos Digitais'
            ],
            [
                'name' => 'membros_da_gerencia_de_midias_e_conteúdos_digitais',
                'description' => 'Membros da Gerência de Mídias e Conteúdos Digitais'
            ],
            [
                'name' => 'gerente_de_ensino_mediado_por_tecnologia',
                'description' => 'Gerente de Ensino Mediado por Tecnologia'
            ],
            [
                'name' => 'membros_da_gerencia_de_ensino_mediado_por_tecnologia',
                'description' => 'Membros da Gerência de Ensino Mediado por Tecnologia'
            ],
            [
                'name' => 'gerente_de_operacoes_e_suporte',
                'description' => 'Gerente de Operações e Suporte'
            ],
            [
                'name' => 'membros_da_gerencia_de_operacoes_e_suporte',
                'description' => 'Membros da Gerência de Operações e Suporte'
            ],
            [
                'name' => 'diretoria_do_cemeam',
                'description' => 'Diretor(a)'
            ],
            [
                'name' => 'nucleo_de_assessoramento_de_tecnologia_educacional',
                'description' => 'Nucleo de Assessoramento de Tecnologia Educacional'
            ],
        ];

        foreach ($roles as $role){
            Role::factory()->create($role);
        }
    }
}
