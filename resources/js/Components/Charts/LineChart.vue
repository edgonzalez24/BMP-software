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
const dummy = {
  "2022-11-01": 0,
  "2022-11-02": 0,
  "2022-11-03": 0
}
  const chartData = {
    labels: Object.keys(dummy),
    datasets: [
      {
        label: 'Mes Actual',
        backgroundColor: '#404E67',
        borderColor: '#404E67',
        fill: false,
        lineTension: 0,
        data: [40, 0]
      },
      {
        label: 'Mes Anterior',
        fill: false,
        borderColor: '#c4c4c4',
        backgroundColor: '#c4c4c4',
        lineTension: 0,
        data: [500, 0]
      }
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