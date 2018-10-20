<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories=[
          'Teologie',
          'Istorie',
          'Ecleziologie (Istoria Bisericii)',
          'Cărți unice',
          'Comentarii Vechiul Testament',
          'Comentarii Noul Testament',
          'Lucrare Creștină / Conducere',
          'Consiliere Pastorală',
          'Viața Creștină',
          'Rugăciune',
          'Evanghelizare',
          'Ucenizare',
          'Cărți pentru copii',
          'Biografii',
          'Istoria Organizațiilor Creștine',
          'Romane',
          'Istorie Generală',
          'Apologetică',
          'Puncte de vedere a lumii',
          'Culte',
          'Studii Biblice',
          'Prezentări Biblice',
          'Cercetare Științifică',
          'Devoționale',
          'Comentarii Generale (Referințe)',
          'Dicționare',
          'Biblia',
          'Noul Testament',
          'Noul Testament (Devotațional)'
        ];
        $codes=[
          '000',
          '010',
          '020',
          '1000',
          '110',
          '120',
          '200',
          '210',
          '300',
          '320',
          '330',
          '340',
          '350',
          '400',
          '410',
          '420',
          '430',
          '500',
          '510',
          '520',
          '600',
          '610',
          '620',
          '700',
          '800',
          '830',
          '900',
          '910',
          '920'
        ];

        foreach ($codes as $key=>$value){

            $category= new \App\Category();
            $category->code=$value;
            $category->name=$categories[$key];
            $category->save();

        }
    }
}
