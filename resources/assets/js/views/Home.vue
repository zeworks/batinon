<template>
    <div>
        <b-container fluid>
            <h2 class="u-text-transform-uppercase">
                Dashboard
            </h2>
            <b-row>
                <b-col sm="12" md="4" :key="key" v-for="(card, key) in cards">
                    <div class="c-card c-card--chart" v-if="cards.length">
                        <div class="c-card__body">
                            <h5 class="c-card__title">{{card.title}}</h5>
                            <div class="c-card__value" v-if="card.type ==='value'">{{card.value}}</div>
                            <div class="c-card__value--chart" v-else>
                                <la-cartesian :height="60" :data="card.value">
                                    <la-area :color="card.color" animated prop="value"></la-area>
                                </la-cartesian>
                            </div>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    import {
        Cartesian,
        Area
    } from 'laue'
    import axios from 'axios';

    export default {
        components: {
            LaCartesian: Cartesian,
            LaArea: Area
        },
        data() {
            return {
                cards: [],
                interval: 50000,
            }
        },
        mounted() {            
            this.fetch();
            setInterval(() => {
                this.fetch();
            }, this.interval);
        },
        methods: {
            fetch() {
                axios.get('/api/dashboard')
                    .then((res) => {
                        this.$set(this.$data, 'cards', res.data.cards)
					});
            }
        }
    }
</script>

<style>

</style>