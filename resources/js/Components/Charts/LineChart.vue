<script setup>
  import { Line } from 'vue-chartjs';
  import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    CategoryScale
  } from 'chart.js';

  ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    CategoryScale
  );
  const props = defineProps({
    chartId: {
      type: String,
      default: 'line-chart'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Array,
      default: () => []
    }
  });
  const chartData = {
    labels: ['cliente 1', 'cliente 2', 'cliente 3', 'cliente 4', 'cliente 5'],
    datasets: [
      {
        label: 'Número de pedidos',
        backgroundColor: '#404E67',
        borderColor: '#d1d5db',
        fill: false,
        lineTension: 0,
        data: [50, 30, 22, 20, 20]
      },
    ]
  }

  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      display: false,
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        },
        gridLines: {
          display: true
        }
      }],
      xAxes: [{
        type: 'time',
        time: {
          tooltipFormat: 'MMM DD',
          unit: 'day',
          unitStepSize: 5,
          displayFormats: {
            'day': 'DD'
          }
        },
        gridLines: {
          display: false
        }
      }]
    },
    tooltips: {
      mode: 'label'
    },
  }
</script>

<template>
  <Line
    class="w-full"
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
</template>