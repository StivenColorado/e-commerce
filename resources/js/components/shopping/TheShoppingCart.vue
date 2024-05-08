<template>
    <div>
        <h1 class="w-100 text-white text-center">Productos en el Carrito</h1>
        <div v-if="cartItems.length === 0">
            <p class="w-100 text-white text-center">No hay items en el carrito.</p>
        </div>
        <table id="cartTable" class="table" v-if="cartItems.length > 0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in cartItems" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.product.name }}</td>
                    <td>
                        <input type="number" v-model="item.quantity">
                        <button @click="updateQuantity(item)">Actualizar</button>
                    </td>
                    <td>
                        <button @click="removeItem(item)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['cartItems'], // Define la prop cartItems
    methods: {
        // Aquí van los métodos de tu componente
        updateQuantity(item) {
            // Lógica para actualizar la cantidad de un item en el carrito
            // Puedes hacer una petición PUT a una ruta de actualización en el servidor
            // Aquí solo se muestra un ejemplo básico de actualización local
        },
        removeItem(item) {
            // Lógica para eliminar un item del carrito
            // Puedes hacer una petición DELETE a una ruta de eliminación en el servidor
            // Aquí solo se muestra un ejemplo básico de eliminación local
            const index = this.cartItems.indexOf(item);
            if (index !== -1) {
                this.cartItems.splice(index, 1);
            }
        }
    }
};
</script>

<style>
/* Agrega estilos CSS según sea necesario para tu tabla y otros elementos */
</style>
