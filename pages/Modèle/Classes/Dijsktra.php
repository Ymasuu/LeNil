<?
function dijkstra($graph, $start) {
    $distances = array();
    $visited = array();
    $queue = new SplPriorityQueue();

    foreach ($graph as $vertex => $adj) {
        $distances[$vertex] = INF;
        $visited[$vertex] = false;
    }

    $distances[$start] = 0;
    $queue->insert($start, 0);

    while (!$queue->isEmpty()) {
        $current = $queue->extract();

        if ($visited[$current]) {
            continue;
        }

        $visited[$current] = true;

        foreach ($graph[$current] as $neighbor => $weight) {
            $alt = $distances[$current] + $weight;

            if ($alt < $distances[$neighbor]) {
                $distances[$neighbor] = $alt;
                $queue->insert($neighbor, -$alt);
            }
        }
    }

    return $distances;
}
?>
