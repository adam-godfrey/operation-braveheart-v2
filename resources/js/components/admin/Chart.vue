<template>
  <canvas ref="myChart" :width="width" :height="height"></canvas>
</template>

<script>
import Chart from 'chart.js';
export default {
  name: 'monthly-sales-chart',
  props: {
    type: {
      type: String,
      required: true
    },
    // The canvas's width.
    width: {
      type: Number,
      validator: value => value > 0
    },
    // The canvas's height.
    height: {
      type: Number,
      validator: value => value > 0
    },
    // The chart's data.labels
    labels: Array,
    // The chart's data.datasets
    datasets: {
      type: Array,
      required: true
    },
    // The chart's options.
    options: String
  },
  data() {
    return {
      chart: null,
    };
  },
  watch: {
    datasets(newDatasets) {
      // Replace the datasets and call the update() method on Chart.js
      // instance to re-render the chart.
      this.chart.data.datasets = newDatasets;
      this.chart.update();
    }
  },
  mounted() {
    this.chart = new Chart(this.$refs.myChart, {
      type: this.type,
      data: {
        labels: this.labels,
        datasets: this.datasets
      },
      options: JSON.parse(this.options),
    });
  },
  beforeDestroy () {
    // Don't forget to destroy the Chart.js instance.
    if (this.chart) {
      this.chart.destroy()
    }
  },
}
</script>