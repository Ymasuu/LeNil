<?php 
// Un tableau associatif pour représenter les sommets d'un graphe non-orienté et pondéré
$graph = [
    "LeNil" => ["Adresse1" => 5, "Adresse2" => 3, "Adresse3" => 2, "Adresse5" => 3],
    "Adresse1" => ["LeNil" => 5, "Adresse11" => 3, "Adresse12" => 3],
    "Adresse2" => ["LeNil" => 3, "Adresse4" => 4, "Adresse12" => 4, "Adresse14" => 8],
    "Adresse3" => ["LeNil" => 2, "Adresse4" => 7],
    "Adresse4" => ["Adresse2" => 4, "Adresse3" => 7, "Adresse10" => 6],
    "Adresse5" => ["LeNil" => 3, "Adresse6" => 6, "Adresse8" => 6, "Adresse9" => 3],
    "Adresse6" => ["Adresse5" => 6, "Adresse9" => 4, "Adresse10" => 11],
    "Adresse7" => ["Adresse8" => 3, "Adresse9" => 4],
    "Adresse8" => ["Adresse5" => 6, "Adresse7" => 3, "Adresse11" => 4],
    "Adresse9" => ["Adresse5" => 3, "Adresse6" => 4, "Adresse7" => 4],
    "Adresse10" => ["Adresse4" => 6, "Adresse6" => 11],
    "Adresse11" => ["Adresse1" => 3, "Adresse8" => 4, "Adresse12" => 5],
    "Adresse12" => ["Adresse1" => 3, "Adresse2" => 4, "Adresse11" => 5, "Adresse13" => 5],
    "Adresse13" => ["Adresse12" => 5, "Adresse14" => 6],
    "Adresse14" => ["Adresse2" => 8, "Adresse13" => 6],
];

// affiche le graphe
function afficheGraphe($graph) {
    foreach ($graph as $sommet => $voisins) {
        echo "$sommet -> \n";
        foreach ($voisins as $voisin => $distance) {
            echo "voisin: $voisin, distance: $distance\n ";
        }
        echo " \r ";
    }
}

function dijkstra($graph,$start,$end){
    $distances = [];
    $visited = [];
    $previous = [];
    $queue = new SplPriorityQueue();

    foreach ($graph as $vertex => $adjacent) {
        $distances[$vertex] = INF;
        $previous[$vertex] = null;
        $visited[$vertex] = false;
        }
    $distances[$start] = 0;
    $queue->insert($start, 0);

    while (!$queue->isEmpty()) {
        $current = $queue->extract();

        if ($current === $end) {break;}
        if ($visited[$current]) {continue;}
        $visited[$current] = true;

        foreach ($graph[$current] as $neighbor => $distance) {
            if (!$visited[$neighbor]){
                $alt = $distances[$current] + $distance;
                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $current;
                    $queue->insert($neighbor, -$alt);
                }
            }
        }
    }

    $path = [];
    $current = $end;

    while ($current !== null) {
        array_push($path, $current);
        $current = $previous[$current] ?? null;
    }

    $path = array_reverse($path);

    return $path;
}

$start = "LeNil";
$end = "Adresse10";

$path = dijkstra($graph, $start, $end);

echo "Chemin le plus court entre $start et $end: ";
foreach ($path as $key => $value) {
    echo "$value";
    if ($key < count($path) - 1) {
        echo " -> ";
    }
}
echo " \r ";

?>