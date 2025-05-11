<?php
namespace App\Lib;
use Symfony\Component\HttpClient\HttpClient;

class api
{
    public function getCharacters(int $Id): array
    {

        If($Id > 1){
            $Id = ($Id - 1) * 12 + 1;
            $Id2 = $Id + 1;
            $Id3 = $Id + 2;
            $Id4 = $Id + 3;
            $Id5 = $Id + 4;
            $Id6 = $Id + 5;
            $Id7 = $Id + 6;
            $Id8 = $Id + 7;
            $Id9 = $Id + 8;
            $Id10 = $Id + 9;
            $Id11 = $Id + 10;
            $Id12 = $Id + 11;
        } else {
            If($Id == 1){
                $Id2 = $Id + 1;
                $Id3 = $Id + 2;
                $Id4 = $Id + 3;
                $Id5 = $Id + 4;
                $Id6 = $Id + 5;
                $Id7 = $Id + 6;
                $Id8 = $Id + 7;
                $Id9 = $Id + 8;
                $Id10 = $Id + 9;
                $Id11 = $Id + 10;
                $Id12 = $Id + 11;
            } else {
                return $Content=[
                    'Error' => 'Do not select pages below 1.',
                ];
            }
        }
        $Client = HttpClient::create();
        $Url="https://rickandmortyapi.com/api/character/$Id,$Id2,$Id3,$Id4,$Id5,$Id6,$Id7,$Id8,$Id9,$Id10,$Id11,$Id12";
        $Response = $Client->request(
            'GET',
            $Url
        );

        $Content = $Response->getContent();

        $Content = $Response->toArray();

        if (empty($Content)) {
            $Content=['Error' => 'Empty result.'];
        }

        return $Content;
    }

    public function getEpisodes() : array
    {
        $Client = HttpClient::create();
                $Url = "https://rickandmortyapi.com/api/episode";
                $Response = $Client->request(
                    'GET',
                    $Url
                );
                $Content = $Response->getContent();

                $Content = $Response->toArray();

                $Episodes = [];
                $J = $Content['info']['count'] + 1;
                for ($I=1; $I < $J; $I++) {
                    $Url="https://rickandmortyapi.com/api/episode/".$I;
                    $Response = $Client->request(
                        'GET',
                        $Url
                    );
                    $Content = $Response->getContent();

                    $Content = $Response->toArray();

                    $Episodes[$I] = $Content;
                }
        return $Episodes;
    }

    public function getData(array $Charaters, array $Episodes) : array
    {
        foreach ($Charaters as $Persons => $Person) {
            foreach ($Person['episode'] as $EpisodeId => $Episode) {
                $Charaters[$Persons]['episode'][$EpisodeId]=$Episodes[$EpisodeId+1];
            }
        }
        return $Charaters;
    }
}
