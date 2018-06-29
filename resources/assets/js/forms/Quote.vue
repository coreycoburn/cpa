<template>
    <div>
        <form id="quote-form" method="POST" action="#" @submit.prevent="" @keydown.enter.prevent="">
            <div class="flex border-b mb-6">
                <div>
                    <h2 class="mb-4">{{ formTitle }}</h2>
                </div>
                <div class="flex-1 text-right">
                    Step
                        <span class="bg-blue-light rounded-full inline-flex items-center justify-center text-white h-6 w-6">
                            {{ step }}
                        </span> of {{ finalStep }}
                </div>
            </div>

            <div v-show="step === 1">
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
                    <div class="w-2/5">
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
                <h4 class="mb-2">Contact Address</h4>
                <div class="mb-4 w-full">
                    <app-input
                        field="contact_address"
                        title="Address"
                        v-model="form.contact_address"
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
            </div>

            <div v-show="step === 2">
                <div class="mb-4 w-full">
                    <div class="mb-2" :class="{ 'text-red-dark font-bold': errors['services'] }">
                        <h4 class="mb-2">Services <span class="text-red">*</span></h4>
                    </div>
                    <div class="flex mb-4">
                        <div class="flex-1">
                            <app-checkbox
                                group="services"
                                field="service_valet"
                                title="Valet Parking"
                                v-model="form.services.valet"
                                :errors="errors"
                            />
                        </div>
                        <div class="flex-1">
                            <app-checkbox
                                group="services"
                                field="service_direction"
                                title="Parking Direction"
                                :errors="errors"
                                v-model="form.services.direction"
                            />
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="flex-1">
                            <app-checkbox
                                group="services"
                                field="service_shuttle"
                                title="Shuttle"
                                :errors="errors"
                                v-model="form.services.shuttle"
                            />
                        </div>
                        <div class="flex-1">
                            <app-checkbox
                                group="services"
                                field="service_coordination"
                                title="Parking Coordination"
                                :errors="errors"
                                v-model="form.services.coordination"
                            />
                        </div>
                    </div>
                    <transition name="fade">
                        <span
                            class="text-sm text-red-dark mt-2 block"
                            role="alert"
                            v-if="errors['services']"
                        >
                            {{ errors['services'][0] }}
                        </span>
                    </transition>
                </div>

                <div class="flex mb-4">
                    <div class="w-1/2 mr-2">
                        <app-input
                            field="event_type"
                            title="Event Type"
                            v-model="form.event_type"
                            help="i.e. wedding, fundraiser, private party"
                        />
                    </div>
                    <div class="w-1/2">
                        <app-input
                            field="location_type"
                            title="Location Type"
                            v-model="form.location_type"
                            help="i.e. residential, restaurant, winery"
                        />
                    </div>
                </div>
                <div class="mb-4 w-full">
                    <app-input
                        field="location_name"
                        title="Location Name"
                        v-model="form.location_name"
                    />
                </div>
                <div class="flex mb-4">
                    <div class="w-1/2 mr-2">
                        <datetime
                            v-model="form.event_date"
                            field="event_date"
                            type="date"
                            input-class="rounded w-full py-2 px-3 text-grey-darker leading-tight"
                            value-zone="America/Los_Angeles"
                            auto
                            :week-start=6
                            :min-datetime="today"
                            class="datetime-theme"
                            title="Event Date"
                            :errors="errors"
                            :required=true
                        />
                    </div>
                    <div class="w-1/2">
                        <datetime
                            v-model="form.start"
                            field="start"
                            type="time"
                            input-class="rounded w-full py-2 px-3 text-grey-darker leading-tight"
                            value-zone="America/Los_Angeles"
                            :minute-step=15
                            use12-hour
                            auto
                            :format="{ hour: 'numeric', minute: '2-digit' }"
                            class="datetime-theme"
                            title="Guest Arrival Time"
                            help="Time your 1st guest will arrive"
                            :errors="errors"
                            :required=true
                        />
                    </div>
                </div>
                <div class="flex mb-4">
                    <div class="w-1/2 mr-2">
                        <datetime
                            v-model="form.start_advertised"
                            field="start_advertised"
                            type="time"
                            input-class="rounded w-full py-2 px-3 text-grey-darker leading-tight"
                            value-zone="America/Los_Angeles"
                            :minute-step=15
                            use12-hour
                            auto
                            :format="{ hour: 'numeric', minute: '2-digit' }"
                            class="datetime-theme"
                            title="Advertised Start Time"
                            help="Time advertised on invitation"
                            :errors="errors"
                            :required=true
                        />
                    </div>
                    <div class="w-1/2">
                        <datetime
                            v-model="form.end"
                            field="end"
                            type="time"
                            input-class="rounded w-full py-2 px-3 text-grey-darker leading-tight"
                            value-zone="America/Los_Angeles"
                            :minute-step=15
                            use12-hour
                            auto
                            :format="{ hour: 'numeric', minute: '2-digit' }"
                            class="datetime-theme"
                            title="Event End Time"
                            :errors="errors"
                            :required=true
                        />
                    </div>
                </div>
                <div class="flex mb-4">
                    <div class="w-1/2 mr-2">
                        <app-input
                            field="guests"
                            title="Guest Count"
                            v-model="form.guests"
                            :errors="errors"
                            :required=true
                            help="i.e. 100 or 150-175"
                        />
                    </div>
                    <div class="w-1/2 mr-2">
                        <app-input
                            field="cars"
                            title="Car Count"
                            v-model="form.cars"
                            :errors="errors"
                            :required=true
                            help="Your best estimation"
                        />
                    </div>
                </div>
                <h4 class="mb-2">Event Address</h4>
                <div class="w-full mb-4">
                    <app-checkbox
                        field="copy_address"
                        title="Same as Contact Address"
                        v-model="copyAddressBox"
                    />
                </div>
                <div class="w-full mb-4">
                    <app-input
                        field="event_address"
                        title="Address"
                        v-model="form.event_address"
                    />
                </div>
                <div class="flex mb-4">
                    <div class="w-2/5 mr-2">
                        <app-input
                            field="event_city"
                            title="City"
                            v-model="form.event_city"
                        />
                    </div>
                    <div class="w-2/5 mr-2">
                        <app-select
                            field="event_state"
                            title="State"
                            v-model="form.event_state"
                            :options=states
                        />
                    </div>
                    <div class="w-1/5">
                        <app-input
                            field="event_zip"
                            title="Zip"
                            v-model="form.event_zip"
                        />
                    </div>
                </div>
            </div>

            <div v-show="step === 3">
                page 3
            </div>

            <div class="flex mt-8 mb-3 pt-6 border-t">
                <div class="w-1/2 flex">
                    <button v-if="step > 1"
                        class="bg-transparent border border-green hover:bg-green hover:text-white text-green uppercase font-bold py-2 px-4 rounded h-12 w-32"
                        @click="prev"
                        v-scroll-to="{ el: '#quote-container', offset: -52 }"
                    >
                        Previous
                    </button>
                </div>
                <div class="w-1/2 flex justify-end">
                    <button v-if="step < finalStep"
                        class="bg-green hover:bg-green-dark text-white uppercase font-bold py-2 px-4 rounded h-12 w-32"
                        @click="next"
                        v-scroll-to="{ el: '#quote-container', offset: -52 }"
                    >
                        Next
                    </button>
                    <button v-else
                        class="bg-blue hover:bg-blue-dark text-white uppercase font-bold py-2 px-4 rounded h-12 w-32"
                        :class="{ 'cursor-not-allowed': processing }"
                        :disabled="processing"
                        @click="submit"
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
                </div>
            </div>
        </form>

        <sweet-modal ref="quoteModal" title="Thank You!" icon="success" overlay-theme="dark">
            <p class="text-xl">
                We have received your quote request. We will contact you within the next business day.
            </p>
        </sweet-modal>
    </div>
</template>

<script>
import { HollowDotsSpinner } from 'epic-spinners'
import AppSelect from '../components/Select'
import AppInput from '../components/Input'
import AppCheckbox from '../components/Checkbox'
import { honorifics, states } from './options'
import VueScrollTo from 'vue-scrollto'
import moment from 'moment'

export default {
    components: {
        HollowDotsSpinner,
        AppSelect,
        AppInput,
        AppCheckbox
    },
    data() {
        return {
            pageTitles: ['Contact Info', 'Event Info', 'Additional Info'],
            step: 1,
            finalStep: 3,
            streetNumber: '',
            route: '',
            today: moment().format(),
            copyAddressBox: false,
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
                contact_zip: '',
                services: {
                    valet: false,
                    direction: false,
                    shuttle: false,
                    coordination: false
                },
                event_type: '',
                location_type: '',
                location_name: '',
                event_date: '',
                start: '',
                start_advertised: '',
                end: '',
                guests: '',
                cars: '',
                event_address: '',
                event_city: ''
            },
            honorifics,
            states,
            errors: [],
            processing: false
        }
    },
    methods: {
        prev() {
            this.step--
        },

        next() {
            this.step++
        },

        async submit() {
            this.processing = true

            try {
                const response = await axios.post('quote', this.form)

                this.processing = false
                this.$refs.quoteModal.open()
                document.getElementById('quote-form').reset()
                Object.assign(this.$data, this.$options.data())
                this.step = 1
                VueScrollTo.scrollTo('body', 500, { offset: -52 })

                console.log(response.data)
            } catch (error) {
                this.errors = error.response.data.errors

                this.processing = false
                this.step = this.errorPage()
                VueScrollTo.scrollTo('#quote-container', 500, { offset: -52 })
                this.flash(
                    'Whoops! 😯 Please fix the validation errors.',
                    'fixed pin-b pin-r mr-6 mb-6 bg-red text-white rounded p-6'
                )
            }
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
                            this.streetNumber = long_name
                        }
                        if (types[0] === 'route') {
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
        },
        errorPage() {
            const errors = [
                { key: 'social_title', page: 1 },
                { key: 'fname', page: 1 },
                { key: 'lname', page: 1 },
                { key: 'phone', page: 1 },
                { key: 'email', page: 1 },
                { key: 'services', page: 2 }
            ]

            let pageList = []

            errors.forEach(({ key, page }) => {
                if (Object.keys(this.errors).includes(key)) {
                    pageList.push(page)
                }
            })

            return Math.min(...pageList)
        }
    },
    computed: {
        formTitle() {
            return this.pageTitles[this.step - 1]
        },
        address() {
            return `${this.streetNumber} ${this.route}`
        }
    },
    watch: {
        copyAddressBox() {
            if (this.copyAddressBox) {
                this.form.event_address = this.form.contact_address
                this.form.event_city = this.form.contact_city
                this.form.event_state = this.form.contact_state
                this.form.event_zip = this.form.contact_zip
            } else {
                this.form.event_address = ''
                this.form.event_city = ''
                this.form.event_state = ''
                this.form.event_zip = ''
            }
        }
    },
    mounted() {
        //this.googleAutocomplete()
    }
}
</script>
