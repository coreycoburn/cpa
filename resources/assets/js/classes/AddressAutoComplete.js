class AddressAutoComplete {
    constructor(selectorID, fields, form) {
        const selector = document.getElementById(selectorID)
        this.fields = fields
        this.form = form
        this.streetNumber = ''
        this.route = ''

        const autocomplete = this.setup(selector)
        this.listen(autocomplete, selector)
    }

    setup(selector) {
        return new google.maps.places.Autocomplete(
            selector, { types: ['geocode'] }
        )
    }

    listen(autocomplete, selector) {
        google.maps.event.clearInstanceListeners(selector)

        google.maps.event.addListener(autocomplete, 'place_changed', () => {
            const place = autocomplete.getPlace()
            const ac = place.address_components

            const components = this.components()

            for (const component in components) {
                ac.forEach(addressComponent => this.populateFormElements(addressComponent, components[component]))
            }

            document.getElementById(this.fields[3]).focus()
        })
    }

    components() {
        return [
            { component: 'street_number', id: 'street_number', key: 'long_name' },
            { component: 'route', id: 'route', key: 'long_name' },
            { component: 'address', id: this.fields[0], key: 'long_name' },
            { component: 'sublocality_level_1', id: this.fields[1], key: 'long_name' },
            { component: 'locality', id: this.fields[1], key: 'long_name' },
            { component: 'administrative_area_level_1', id: this.fields[2], key: 'short_name' },
            { component: 'postal_code', id: this.fields[3], key: 'long_name' }
        ]
    }

    populateFormElements(addressComponent, formMap) {
        const addressType = addressComponent.types[0]

        if (addressType === 'street_number') {
            this.streetNumber = addressComponent[formMap.key]
        }
        if (addressType === 'route') {
            this.route = addressComponent[formMap.key]
        }

        if (formMap.component === 'address') {
            this.form[formMap.id] = `${this.streetNumber} ${this.route}`
        }

        if (formMap.component === addressType) {
            let formValue = addressComponent[formMap.key]
            this.form[formMap.id] = formValue
        }
    }
}

export default AddressAutoComplete
