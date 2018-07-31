<template>
  <div>
    <div v-if="loading" class="capitalize">
      <div class="mb-6 text-brand-dark text-lg font-bold">
        Loading {{ type }}
      </div>
      <div class="flex justify-center">
        <swapping-squares-spinner
          :animation-duration="1000"
          :size="65"
          color="#c8252b"
        />
      </div>
    </div>
    <div class="relative mx-auto" :style="pdfContainerStyle">
      <portal-target
        name="sign-target"
        class="absolute"
        :style="pdfStyle"
        v-if="signButtonShow"
      />

      <canvas id="contract"/>
    </div>
  </div>
</template>

<script>
import { SwappingSquaresSpinner } from "epic-spinners";

export default {
  props: {
    url: {
      required: true,
      type: String
    },
    type: {
      type: String
    },
    scale: {
      default: 1.5,
      type: Number
    },
    sigY: {
      type: Number
    }
  },
  components: {
    SwappingSquaresSpinner
  },
  mounted() {
    /**
     * Canvas scale example
     * https://www.html5rocks.com/en/tutorials/canvas/hidpi/
     */

    const pdfjsLib = window["pdfjs-dist/build/pdf"];

    pdfjsLib.GlobalWorkerOptions.workerSrc =
      "//mozilla.github.io/pdf.js/build/pdf.worker.js";

    const loadingTask = pdfjsLib.getDocument(this.url);

    loadingTask.promise.then(
      pdf => {
        // Fetch the first page
        const pageNumber = 1;
        pdf.getPage(pageNumber).then(page => {
          const viewport = page.getViewport(this.scale);

          // Prepare canvas using PDF page dimensions
          const canvas = document.getElementById("contract");
          const context = canvas.getContext("2d");
          const devicePixelRatio = window.devicePixelRatio || 1;
          const backingStoreRatio =
            context.webkitBackingStorePixelRatio ||
            context.mozBackingStorePixelRatio ||
            context.msBackingStorePixelRatio ||
            context.oBackingStorePixelRatio ||
            context.backingStorePixelRatio ||
            1;

          const ratio = devicePixelRatio / backingStoreRatio;
          const oldWidth = viewport.width;
          const oldHeight = viewport.height;

          canvas.height = viewport.height * ratio;
          canvas.width = viewport.width * ratio;

          canvas.style.height = oldHeight + "px";
          canvas.style.width = oldWidth + "px";

          this.pdfContainerStyle = (oldWidth < screen.width) ?
            `width: ${oldWidth}px;` : '';

          this.pdfStyle = `top: ${(this.sigY * this.scale)}px; left: 305px;`;

          context.scale(ratio, ratio);

          // Render PDF page into canvas context
          const renderContext = {
            canvasContext: context,
            viewport: viewport
          };
          const renderTask = page.render(renderContext);
          renderTask;
        });

        this.signButtonShow = true;
        this.loading = false;
      },
      reason => {
        // PDF loading error
        console.error(reason);
        this.loading = false;
      }
    )
  },
  data() {
    return {
      loading: true,
      signButtonShow: false,
      pdfContainerStyle: '',
      pdfStyle: ''
    };
  }
};
</script>
