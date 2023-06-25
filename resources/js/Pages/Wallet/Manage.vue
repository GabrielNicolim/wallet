<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
  wallet: {
    type: Object,
  },
})
</script>

<template>
  <Head title="Carteira" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ wallet.name }}</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="stock in wallet.stocks" :key="stock.id" class="w-72 md:w-56 xl:w-64 bg-white shadow rounded-lg mx-auto break-all border-2">
              <div class="h-28 p-2">
                <div class="font-bold">{{ stock.name }}</div>
                <div v-if="stock.average_price" class="text-sm text-gray-500">
                  <span class="font-medium">Preço médio: </span>
                  <span>R$ {{ stock.formatted_average_price }}</span>
                </div>
                <div v-if="stock.ceiling_price" class="text-sm text-gray-500">
                  <span class="font-medium">Preço teto: </span>
                  <span>R$ {{ stock.formatted_ceiling_price }}</span>
                </div>
                <div class="text-sm text-gray-500">
                  <span class="font-medium">Quantidade: </span>
                  <span>{{ stock.formatted_quantity }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
