<?php

use common\models\Test;
use common\models\User;
use common\models\Vraag;
use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160404_124748_testData extends Migration
{
    public function safeUp()
    {
        //create users
        $this->insert('user', [
            'username' => 'admin',
            'email' => 'reinier@releaz.nl',
            'password_hash' => Yii::$app->security->generatePasswordHash('asdasd'),
            'status' => 10,
            'isAdmin' => true,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('user', [
            'username' => 'behandelaar',
            'email' => 'test@releaz.nl',
            'password_hash' => Yii::$app->security->generatePasswordHash('asdasd'),
            'status' => 10,
            'isAdmin' => false,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('behandelaar', ArrayHelper::merge([
            'first_name' => 'Jannes',
            'last_name' => 'Dijken',
            'user_id' => User::findOne(['username' => 'behandelaar'])->id,
        ], $this->getCreatedAndUpdated()));

        //clients
        $this->insert('client', ArrayHelper::merge([
            'first_name' => 'Reinier',
            'last_name' => 'De la parra',
            'email' => 'reinier@releaz.nl'
        ], $this->getCreatedAndUpdated()));

        $this->insert('client', ArrayHelper::merge([
            'first_name' => 'Teun',
            'last_name' => 'Bakker',
            'email' => 'teun@releaz.nl'
        ], $this->getCreatedAndUpdated()));

        $this->insert('client', ArrayHelper::merge([
            'first_name' => 'Jorn',
            'last_name' => 'Lemmon',
            'email' => 'jorn@releaz.nl'
        ], $this->getCreatedAndUpdated()));

        $this->insert('client', ArrayHelper::merge([
            'first_name' => 'Edo',
            'last_name' => 'Een achter naam',
            'email' => 'edo@releaz.nl'
        ], $this->getCreatedAndUpdated()));

        //create list
        $this->insert('test', ArrayHelper::merge(['name' => 'list 1'], $this->getCreatedAndUpdated()));

        $testID = Test::findOne(['name' => 'list 1'])->id;

        //blad 1
        $this->insert('vraag', ArrayHelper::merge(['text' => 'Lijkt blij met bezoek van familieleden', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'Lijkt blij met bezoek van familieleden'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'Neemt deel aan gezamenlijke activiteiten', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'Neemt deel aan gezamenlijke activiteiten'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'Is bereid desgevraagd iemand te helpen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'Is bereid desgevraagd iemand te helpen'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'begint uit zichzelf een gesprek met anderen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'begint uit zichzelf een gesprek met anderen'])->id, ['Nooit', 'Bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'heeft contact met de verpleging (met of zonder woorden)', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'heeft contact met de verpleging (met of zonder woorden)'])->id, ['Nooit', 'Soms', 'regelmatig', 'vaal']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'lijkt te luisteren naar wat anderen vertellen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'lijkt te luisteren naar wat anderen vertellen'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'kan met medepatiënten heel goed opschieten', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'kan met medepatiënten heel goed opschieten'])->id, ['niemand', 'enkele', 'meerdere', 'de meeste']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'toont interesse voor personeelsleden', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'toont interesse voor personeelsleden'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        //blad 2
        $this->insert('vraag', ArrayHelper::merge(['text' => 'reageert wanneer hij/zij aangesproken wordt', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'reageert wanneer hij/zij aangesproken wordt'])->id, ['Meestal niet ', 'soms', 'meestal wel', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'leest krant en/ of tijdschrift', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'leest krant en/ of tijdschrift'])->id, ['Nooit', 'Soms', 'regelmatig', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'toont emoties bij niet-alledaagse of ingrijpende gebeurtenissen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'toont emoties bij niet-alledaagse of ingrijpende gebeurtenissen'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'reageert zichtbaar op muziek', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'reageert zichtbaar op muziek'])->id, ['Nooit', 'Soms', 'Vaak', 'meestal']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'kijkt op als er iemand binnenkomt of als er iets gebeurt', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'kijkt op als er iemand binnenkomt of als er iets gebeurt'])->id, ['Nooit', 'Soms', 'Vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'luistert naar de radio en/ of kijkt televisie', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'luistert naar de radio en/ of kijkt televisie'])->id, ['Nooit', 'bijna nooit', 'soms', 'vaak']);

        //blad 3
        $this->insert('vraag', ArrayHelper::merge(['text' => 'raakt in paniek bij het verlaten van de afdeling', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'raakt in paniek bij het verlaten van de afdeling'])->id, ['nooit ', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'laat merken bang te zijn voor bepaalde personen of dingen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'laat merken bang te zijn voor bepaalde personen of dingen'])->id, ['nooit ', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'is plotseling angstig zonder duidelijke reden', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'is plotseling angstig zonder duidelijke reden'])->id, ['nooit ', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'is angstig in aanwezigheid van bepaalde andere cliënten/bewoners', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'is angstig in aanwezigheid van bepaalde andere cliënten/bewoners'])->id, ['nooit ', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'toont angst wanneer hij/zij door het personeel geholpen wordt', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'toont angst wanneer hij/zij door het personeel geholpen wordt'])->id, ['nooit ', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'is angstig in aanwezigheid van \'onbekenden\'', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'is angstig in aanwezigheid van \'onbekenden\''])->id, ['nooit ', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'zit te suffen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'zit te suffen'])->id, ['nooit', 'soms', 'vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'schrikt op uit een droomtoestand als hij/zij wordt aangesproken', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'schrikt op uit een droomtoestand als hij/zij wordt aangesproken'])->id, ['nooit', 'soms', 'vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'maakt een afwezige indruk', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'maakt een afwezige indruk'])->id, ['nooit', 'soms', 'vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'is overdag, indien wakker, klaar wakker', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'is overdag, indien wakker, klaar wakker'])->id, ['nooit', 'soms', 'vaak', 'Altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'moet wakker geschud worden als men hem/haar wil bereiken', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'moet wakker geschud worden als men hem/haar wil bereiken'])->id, ['Nooit', 'Soms', 'Vaak', 'meestal']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'verkeert overdag in een droom- of trance-achtige toestand', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'verkeert overdag in een droom- of trance-achtige toestand'])->id, ['Nooit', 'soms', 'vaak', 'voortdurend']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'suft weg tijdens gesprekken of bezigheden', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'suft weg tijdens gesprekken of bezigheden'])->id, ['Nooit', 'zelden', 'regelmatig', 'meestal']);

        //blad 4
        $this->insert('vraag', ArrayHelper::merge(['text' => 'gedraagt zich afhankelijk ten opzichte van het personeel', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'gedraagt zich afhankelijk ten opzichte van het personeel'])->id, ['Nooit', 'soms', 'vaak', 'altijd']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'vraagt om geholpen te worden bij dingen die hij/zij zelf blijkt te kunnen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'vraagt om geholpen te worden bij dingen die hij/zij zelf blijkt te kunnen'])->id, ['Nooit', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'vraagt personeelsleden om raad of advies', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'vraagt personeelsleden om raad of advies'])->id, ['Nooit', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'probeert op alle mogelijke manieren de aandacht op zich te vestigen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'probeert op alle mogelijke manieren de aandacht op zich te vestigen'])->id, ['Nooit', 'bijna nooit', 'soms', 'vaak']);

        $this->insert('vraag', ArrayHelper::merge(['text' => 'lijkt aarzelend of onzeker in het nemen van kleine beslissingen', 'test_id' => $testID], $this->getCreatedAndUpdated()));
        $this->makeAwnsers(Vraag::findOne(['text' => 'lijkt aarzelend of onzeker in het nemen van kleine beslissingen'])->id, ['Nooit', 'soms', 'vaak', 'altijd']);
    }

    private function getCreatedAndUpdated()
    {
        $date = date('Y-m-d H:i:s');
        return ['created' => $date, 'updated' => $date];
    }

    private function makeAwnsers($vraagID, $awnsers = [])
    {
        for ($i = 1; $i < count($awnsers); $i++) {
            $this->insert('antwoord', ArrayHelper::merge([
                'text' => $awnsers[$i],
                'vraag_id' => $vraagID
            ], $this->getCreatedAndUpdated()));
        }
    }

    public function safeDown()
    {
        $this->delete('user');
        $this->delete('vraag');
        $this->delete('test');
        $this->delete('client');
        $this->delete('behandelaar');
    }
}
