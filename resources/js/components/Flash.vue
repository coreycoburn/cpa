<template>
    <transition name="fade">
        <div class="text-center py-6 px-8 fixed pin-b pin-r mb-16" v-show="show">
            <div
                class="p-2 leading-none rounded-lg flex inline-flex border items-center"
                :class="{
                    'toaster-success': hasSuccess,
                    'toaster-error': hasError
                }"
                role="alert"
            >
                <span class="flex uppercase px-2 py-1 text-lg font-bold">{{ variantTitle }}:</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ body }}</span>
             </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: ['message', 'variant'],
    data() {
        return {
            body: this.body,
            variantTitle: this.variantTitle,
            hasSuccess: false,
            hasError: false,
            show: false
        }
    },
    created() {
        if (this.message) {
            this.flash(this.message, this.variant)

            this.hide()
        }
    },
    methods: {
        flash(message, variant) {
            this.body = message
            this.type(variant)

            this.show = true
        },
        hide() {
            setTimeout(() => {
                this.show = false
            }, 4000)
        },
        type(variant) {
            if (variant == '' || variant == 'success') {
                this.variantTitle = 'success'
                this.hasSuccess = true

                return
            }
            if (variant == 'error') {
                this.variantTitle = 'error'
                this.hasError = true

                return
            }
        }
    }
}
</script>
