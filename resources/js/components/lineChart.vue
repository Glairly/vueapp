<script>
import { Line } from "vue-chartjs";

export default {
    extends: Line,
    props: ["chartdata", "options"],
    watch: {
        chartdata: {
            deep: true,
            handler(_o, _n) {
                // this._chart.destroy();
                this.renderChart(this.chartdata, this.options);
                console.log("adsadas");
            }
        }
    },
    mounted() {
        this.renderChart(this.chartdata, this.options);
    }
};
</script>
