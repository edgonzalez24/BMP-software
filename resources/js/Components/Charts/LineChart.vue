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
    value: {
      type: Array,
      default: () => []
    },
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
    labels: props.value.map(item => item.client ),
    datasets: [
      {
        label: 'Número de preventas',
        backgroundColor: '#404E67',
        borderColor: '#d1d5db',
        fill: false,
        lineTension: 0,
        data: props.value.map(item => item.count_presales),
      },
    ]
  }

  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      display: false,
    },
    scales: {},
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