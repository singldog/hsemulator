export default {
    data () {
        return {
            dialog: false
        }
    },
    methods: {
        open () {
            this.dialog = true
        },
        close () {
            this.dialog = false
        }
    }
}