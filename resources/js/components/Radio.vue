<template>
    <label class="flex items-center text-grey-darker text-sm font-bold pt-1 mr-6">
        <input
            type="radio"
            :name=field
            :checked=check
            @input=updateValue
            @keydown.enter.prevent=""
        >
        <div class="flex flex-col">
            <div>
                {{ title }}
            </div>
            <div class="text-xs">
                {{ subTitle }}
            </div>
        </div>
    </label>
</template>

<script>
export default {
    props: {
        field: {
            required: true,
            type: String,
            description: 'The id / name of the radio field'
        },
        title: {
            required: true,
            type: String,
            description: 'The title of the radio field'
        },
        subTitle: {
            type: String,
            description: 'The sub title of the radio field'
        },
        val: {
            required: true
        },
        check: {
            default: false,
            type: Boolean
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', this.val)
        }
    }
}
</script>
