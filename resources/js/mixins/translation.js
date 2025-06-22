export default {
    methods: {
        $t(key) {
            return window.translations?.[key] || key;
        }
    },
    computed: {
        $lang() {
            return window.currentLocale || 'en';
        },
        $isRTL() {
            return this.$lang === 'ar';
        }
    }
}
