<template>
    <div>
        <form id="quote-form" method="POST" action="#" @submit.prevent="submit" @keydown.enter.prevent="">
            <h3 class="mb-4">Contact Info</h3>
            <div class="flex mb-4">
                <div class="w-1/5 mr-2">
                    <app-select
                        field="social_title"
                        title="Title"
                        v-model="form.social_title"
                        :options=honorifics
                        :errors="errors"
                        :required=true
                    />
                </div>
                <div class="w-2/5 mr-2">
                    <app-input
                        field="fname"
                        title="First Name"
                        v-model="form.fname"
                        :errors="errors"
                        :required=true
                    />
                </div>
                <div class="w-2/5 mr-2">
                    <app-input
                        field="lname"
                        title="Last Name"
                        v-model="form.lname"
                        :errors="errors"
                        :required=true
                    />
                </div>
            </div>
            <div class="mb-4 w-full">
                <app-input
                    field="company"
                    title="Company"
                    v-model="form.company"
                />
            </div>

            <div class="flex mb-4">
                <div class="w-2/5 mr-2">
                    <app-input
                        field="phone"
                        title="Phone"
                        v-model="form.phone"
                        :errors="errors"
                        :required=true
                    />
                </div>
                <div class="w-1/5 mr-2">
                    <app-input
                        field="phone_ext"
                        title="Ext"
                        v-model="form.phone_ext"
                    />
                </div>
                <div class="w-2/5">
                    <app-input
                        field="fax"
                        title="Fax"
                        v-model="form.fax"
                    />
                </div>
            </div>
            <div class="mb-4 w-full">
                <app-input
                    field="email"
                    title="Email"
                    v-model="form.email"
                    :errors="errors"
                    :required=true
                />
            </div>
            <div class="mb-4 w-full">
                <app-input
                    field="contact_address"
                    title="Address"
                    v-model="form.contact_address"
                    reference="test"
                />
            </div>
            <div class="flex mb-4">
                <div class="w-2/5 mr-2">
                    <app-input
                        field="contact_city"
                        title="City"
                        v-model="form.contact_city"
                    />
                </div>
                <div class="w-2/5 mr-2">
                    <app-select
                        field="contact_state"
                        title="State"
                        v-model="form.contact_state"
                        :options=states
                    />
                </div>
                <div class="w-1/5">
                    <app-input
                        field="contact_zip"
                        title="Zip"
                        v-model="form.contact_zip"
                    />
                </div>
            </div>

            <button
                class="bg-blue hover:bg-blue-dark text-white uppercase font-bold py-2 px-4 rounded h-12 w-32"
                :class="{ 'cursor-not-allowed': processing }"
                :disabled="processing"
            >
                <div v-show="!processing">Submit</div>
                <hollow-dots-spinner
                    :animation-duration="1000"
                    :dot-size="15"
                    :dots-num="3"
                    :color="'#fff'"
                    v-show="processing"
                />
            </button>
        </form>
        <sweet-modal ref="quoteModal" title="Thank You!" icon="success" overlay-theme="dark">
            We have received your quote request. We will contact you within the next business day.
        </sweet-modal>
    </div>
</template>

<script>
import { HollowDotsSpinner } from 'epic-spinners'
import AppSelect from '../components/Select'
import AppInput from '../components/Input'
import { honorifics, states } from './options'

export default {
    components: {
        HollowDotsSpinner,
        AppSelect,
        AppInput
    },
    data() {
        return {
            streetNumber: '',
            route: '',
            form: {
                social_title: '',
                fname: '',
                lname: '',
                company: '',
                phone: '',
                phone_ext: '',
                fax: '',
                email: '',
                contact_address: '',
                contact_city: '',
                contact_state: '',
                contact_zip: ''
            },
            honorifics,
            states,
            errors: [],
            processing: false
        }
    },
    methods: {
        async submit() {
            this.processing = true

            try {
                await axios.post('quote', this.form)
            } catch (error) {
                this.errors = error.response.data.errors
                this.processing = false

                return
            }

            this.processing = false
            this.$refs.quoteModal.open()
            this.form = {}
            document.getElementById('quote-form').reset()
        },

        googleAutocomplete() {
            this.autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('contact_address'),
                { types: ['geocode'] }
            )

            this.autocomplete.addListener('place_changed', () => {
                let place = this.autocomplete.getPlace()
                let ac = place.address_components
                let addressNumber = ac[0]['long_name']
                let addressName = ac[1]['long_name']
                this.form.contact_city = place.vicinity

                let lat = place.geometry.location.lat()
                let lon = place.geometry.location.lng()

                place.address_components.forEach(
                    ({ long_name, short_name, types }) => {
                        if (types[0] === 'street_number') {
                            // let streetNumber = long_name
                            console.log(long_name)
                            this.streetNumber = long_name
                        }
                        if (types[0] === 'route') {
                            // let route = long_name
                            console.log(long_name)
                            this.route = long_name
                        }
                        if (types[0] === 'administrative_area_level_1') {
                            this.form.contact_state = short_name
                        }
                        if (types[0] === 'postal_code') {
                            this.form.contact_zip = long_name
                        }
                    }
                )

                this.form.contact_address = this.address

                document.getElementById('contact_zip').focus()
            })
        }
    },
    computed: {
        address() {
            return `${this.streetNumber} ${this.route}`
        }
    },
    mounted() {
        this.googleAutocomplete()
    }
}
</script>
