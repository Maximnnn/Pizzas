<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{pizza.name}} - {{pizza.price}}$</div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td colspan>Pizza</td>
                                <td colspan>Ingredients</td>
                            </tr>

                            <td>
                                <tr v-for="(ingredient) in pizzaIngredients">
                                    <td>{{ingredient.name}} <button @click="remove(ingredient)">Remove</button></td>
                                </tr>
                            </td>

                            <td>
                                <tr v-for="(ingredient) in allIngredients">
                                    <td v-if="!exist(ingredient)">{{ingredient.name}} <button @click="add(ingredient)">Add</button></td>
                                </tr>
                            </td>

                        </table>

                        <button class="btn btn-success" v-on:click="update">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'pizza': {},
            'ingredients': {}
            },
        data: function() {
            return {
                pizzaIngredients: [],
                allIngredients: []
            };
        },
        mounted() {
            this.pizzaIngredients = this.ingredients;
            this.fetch();
        },
        methods: {
            fetch : function () {
                axios.get('/ingredients/list').then((res) => {
                    this.allIngredients = res.data;
                });
            },
            exist: function(ingredient) {
                return this.pizzaIngredients.some(i => ingredient.id === i.id)
            },
            update: function() {
                axios.post('/pizza/update/' + this.pizza.id, {
                    ingredients: this.pizzaIngredients.map(i => i.id)
                }).then((res) => {
                    this.pizza = res.data;
                    alert('pizza saved')}
                    );
            },
            add: function(ingredient) {
                this.pizzaIngredients.push(ingredient);
            },
            remove: function(ingredient) {
                this.pizzaIngredients = this.pizzaIngredients.filter(i => i.id !== ingredient.id);
            },
        }
    }
</script>
