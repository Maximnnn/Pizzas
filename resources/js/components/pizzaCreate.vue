<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>

                    <tr v-for="ingredient in ingredients">
                        <td>{{ingredient.id}}</td>
                        <td>{{ingredient.name}}</td>
                        <td>{{ingredient.price}}$</td>
                        <td><input type="checkbox" v-model="ingredient.selected"></td>
                    </tr>
                </table>

                <input type="text" v-model="pizzaName" placeholder="type new pizza name">
                <button class="btn btn-success" v-on:click="create">Create Pizza</button>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                ingredients: [],
                pizzaName: ''
            };
        },
        mounted() {
            this.fetchIngredients();
        },
        methods: {
            fetchIngredients : function () {
                axios.get('/ingredients/list').then((res) => {
                    this.ingredients = res.data.data;
                    //this.ingredients.map(i => i.selected = false);
                });
            },
            create: function() {
                axios.post('/pizza/create', {
                    name: this.pizzaName,
                    ingredients: this.ingredients.filter(i => i.selected).map(i => i.id)
                }).then(res => {
                    alert('pizza created');
                    location.reload();
                })
            }
        }
    }
</script>
