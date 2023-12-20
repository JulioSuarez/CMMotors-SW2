<?php

namespace App\Http\Controllers;

use App\Models\DataPoint;
use Illuminate\Http\Request;

/**
 * Autores:
 * Julio Suarez
 * Marco Cruz
 */

class KmeansController extends Controller
{
    public function kMeans($k)
    {
        // datos de la base de datos
        $dataPoints = DataPoint::all();

        // numero de datos y el número de clusters k
        $numDataPoints = count($dataPoints);
        $numClusters = $k;

        // Inicializa los centroides de manera aleatoria
        $centroids = $this->initializeCentroids($dataPoints, $numClusters);

        // Asigna cada punto al centroide más cercano
        $clusters = $this->assignToClusters($dataPoints, $centroids);

        // Itera hasta que la asignación de los puntos no cambie significativamente
        do {
            // Guarda la asignación actual de puntos a clusters
            $prevClusters = $clusters;

            // Recalcula los centroides
            $centroids = $this->calculateCentroids($dataPoints, $clusters, $numClusters);

            // Reasigna cada punto al centroide más cercano
            $clusters = $this->assignToClusters($dataPoints, $centroids);
        } while ($clusters != $prevClusters);

        // Los resultados están en $clusters y $centroids
        // Puedes hacer lo que necesites con ellos
        return response()->json(['clusters' => $clusters, 'centroids' => $centroids]);
    }

    private function initializeCentroids($dataPoints, $numClusters)
    {
        // Asegúrate de que haya suficientes puntos de datos para el número de clusters
        if (count($dataPoints) < $numClusters) {
            throw new \Exception("No hay suficientes puntos de datos para el número de clusters especificado.");
        }

        // Baraja los puntos de datos aleatoriamente
        $shuffledDataPoints = $dataPoints->shuffle();

        // Selecciona los primeros $numClusters puntos como centroides iniciales
        $centroids = $shuffledDataPoints->take($numClusters)->toArray();

        return $centroids;
    }

    private function assignToClusters($dataPoints, $centroids)
    {
        $clusters = [];

        foreach ($dataPoints as $dataPoint) {
            $minDistance = PHP_INT_MAX;
            $assignedCluster = null;

            // Calcula la distancia euclidiana entre el punto y cada centroide
            foreach ($centroids as $clusterIndex => $centroid) {
                $distance = $this->calculateEuclideanDistance($dataPoint, $centroid);

                // Actualiza el cluster asignado si la distancia es menor
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $assignedCluster = $clusterIndex;
                }
            }

            // Asigna el punto al cluster más cercano
            $clusters[$dataPoint->id] = $assignedCluster;
        }

        return $clusters;
    }

    private function calculateEuclideanDistance($point1, $point2)
    {
        // Asegúrate de que ambos puntos tengan las mismas dimensiones
        if (count($point1) != count($point2)) {
            throw new \Exception("Los puntos deben tener la misma cantidad de dimensiones.");
        }

        $dimensions = count($point1);
        $sum = 0;

        // Calcula la suma de los cuadrados de las diferencias en cada dimensión
        for ($i = 0; $i < $dimensions; $i++) {
            $sum += pow($point2[$i] - $point1[$i], 2);
        }

        // Calcula la raíz cuadrada de la suma para obtener la distancia euclidiana
        $distance = sqrt($sum);

        return $distance;
    }

    private function calculateCentroids($dataPoints, $clusters, $numClusters)
    {
        $centroids = [];

        // Inicializa los centroides como arrays vacíos
        for ($i = 0; $i < $numClusters; $i++) {
            $centroids[$i] = array_fill(0, count($dataPoints[0]), 0);
        }

        $clusterCounts = array_fill(0, $numClusters, 0);

        // Suma los valores de cada dimensión para cada cluster
        foreach ($dataPoints as $dataPoint) {
            $clusterIndex = $clusters[$dataPoint->id];

            foreach ($dataPoint as $dim => $value) {
                $centroids[$clusterIndex][$dim] += $value;
            }

            $clusterCounts[$clusterIndex]++;
        }

        // Calcula la media para obtener los nuevos centroides
        for ($i = 0; $i < $numClusters; $i++) {
            for ($j = 0; $j < count($dataPoints[0]); $j++) {
                $centroids[$i][$j] /= $clusterCounts[$i];
            }
        }

        return $centroids;
    }
}
