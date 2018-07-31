<template>
  <canvas :id="canvas"></canvas>
</template>

<script>
export default {
  props: {
    canvas: {
      required: true,
      type: String
    },
    width: {
      default: 200,
      type: Number
    },
    height: {
      default: 100,
      type: Number
    }
  },
  watch: {
    width() {
      this.setCanvas();
    }
  },
  mounted() {
    this.setCanvas();
  },
  methods: {
    setCanvas() {
      const canvas = document.getElementById(this.canvas);
      canvas.width = this.width;
      canvas.hieght = this.height;
    }
  }
};
</script>
