<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name'          => 'Psihoterapija 1',
            'demo'          => '5.jpg', //img background
            'description'   => 'Ako tražiš podršku na svom putu ka ispunjenom životu, ličnom i profesionalnom, ako si
                                na životnoj raskrsnici ili ti se sav teret ovoga sveta sručio na leđa, ako se osećaš kao da
                                te vrtlog neraspoloženja i neuspeha vuče ka dnu sve više, da ti nedostaje usmerenje ili
                                neko ko će da ti pomogne da sav taj haos u glavi pretočiš u jasne misli i uspešne akcije
                                - nastavi sa čitanjem, na pravom si mestu.<br/><br/>
                                Zovem se Maja, ja sam <b>doktor medicine, psihoterapeut i life coach</b>, majka jednog
                                tinejdžera i tetka jedne 6-godišnjakinje. Ovo su važne stvari u mom životu.<br/>',
            'price'         => "45000"
        ]);

        DB::table('courses')->insert([
            'name'          => 'Psihoterapija 2',
            'demo'          => 'raskrinkati-manipulaciju.jpg', //img background
            'description'   => 'Ako tražiš podršku na svom putu ka ispunjenom životu, ličnom i profesionalnom, ako si
                                na životnoj raskrsnici ili ti se sav teret ovoga sveta sručio na leđa, ako se osećaš kao da
                                te vrtlog neraspoloženja i neuspeha vuče ka dnu sve više, da ti nedostaje usmerenje ili
                                neko ko će da ti pomogne da sav taj haos u glavi pretočiš u jasne misli i uspešne akcije
                                - nastavi sa čitanjem, na pravom si mestu.<br/><br/>
                                Zovem se Maja, ja sam <b>doktor medicine, psihoterapeut i life coach</b>, majka jednog
                                tinejdžera i tetka jedne 6-godišnjakinje. Ovo su važne stvari u mom životu.<br/>',
            'price'         => "45000"
        ]);

        DB::table('courses')->insert([
            'name'          => 'Psihoterapija 3',
            'demo'          => 'psihoterapija-odakle-da-pocnem.jpg', //img background
            'description'   => 'Ako tražiš podršku na svom putu ka ispunjenom životu, ličnom i profesionalnom, ako si
                                na životnoj raskrsnici ili ti se sav teret ovoga sveta sručio na leđa, ako se osećaš kao da
                                te vrtlog neraspoloženja i neuspeha vuče ka dnu sve više, da ti nedostaje usmerenje ili
                                neko ko će da ti pomogne da sav taj haos u glavi pretočiš u jasne misli i uspešne akcije
                                - nastavi sa čitanjem, na pravom si mestu.<br/><br/>
                                Zovem se Maja, ja sam <b>doktor medicine, psihoterapeut i life coach</b>, majka jednog
                                tinejdžera i tetka jedne 6-godišnjakinje. Ovo su važne stvari u mom životu.<br/>',
            'price'         => "45000"
        ]);
    }
}
