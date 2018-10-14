<template>
    <header class="c-header">
        <!-- logout form -->
        <form id="logout-form" :action="logout" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <button>logout</button>
        </form>
        <!-- logout form ends -->
    </header>
</template>

<script>
    export default {
        props: ['logout'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
        }
    }
</script>