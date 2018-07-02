<template>
    <div>
        <label
            class="block text-grey-darker text-sm font-bold mb-2"
            :for="field"
        >
            {{ title }}
        </label>
        <textarea
            class="appearance-none rounded w-full py-2 px-3 text-grey-darker leading-tight h-32"
            :id="field"
            :name="field"
            type="text"
            :placeholder="this.help ? this.help : this.title"
            @input="updateValue($event.target.value)"
        >{{ value }}</textarea>
    </div>
</template>

<script>
export default {
    props: {
        field: {
            required: true,
            type: String,
            description: 'The id / name of the input field'
        },
        title: {
            required: true,
            type: String,
            description: 'The title of the input field'
        },
        value: {
            required: true
        },
        help: {
            type: String
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', value)
        }
    }
}
</script>
