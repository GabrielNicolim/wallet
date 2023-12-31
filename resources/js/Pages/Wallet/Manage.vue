<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import Chart from '@/Components/Chart.vue'

defineProps({
  wallet: {
    type: Object,
  },
  consolidatedPortfolio: {
    type: Object,
  },
  sectorPortfolio: {
    type: Object,
  },
})
</script>

<template>
  <Head title="Carteira" />

  <AuthenticatedLayout :wallet="wallet">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ wallet.name }}</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="sm:flex justify-between mb-4">
            <h2 class="text-lg font-medium text-gray-900">Ativos</h2>
            <div class="flex">
              <Link 
                :href="route('stock.create', wallet.id)"
                method="get"
                as="button"
                class="block p-2 bg-indigo-400 hover:bg-indigo-500 text-white rounded-md shadow mr-2"
              >
                Adicionar ativo
              </Link>
            </div>
          </div>
          <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="stock in wallet.stocks" :key="stock.id" class="w-72 md:w-56 xl:w-64 bg-white shadow rounded-lg mx-auto break-all border-2">
              <div class="h-32 p-2">
                <div class="font-bold py-1">
                  <span>{{ stock.name }}</span>
                  <Link
                    :href="route('stock.edit', {
                      wallet: wallet.id,
                      stock: stock.id
                    })"
                    method="get"
                    as="button"
                    class="ml-2 cursor-pointer"
                  >
                    <i class="fa-regular fa-pen-to-square" />
                  </Link>  
                </div>
                <div v-if="stock.formatted_average_price" class="text-sm text-gray-500">
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
                <div class="text-sm text-gray-500">
                  <span class="font-medium">Setor: </span>
                  <span>{{ stock.sector.name }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="sm:flex justify-between mb-4">
            <h2 class="text-lg font-medium text-gray-900">Informações</h2>
          </div>
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex justify-center">
              <Chart 
                :chart-data="consolidatedPortfolio.chartData"
                :chart-options="consolidatedPortfolio.chartOptions"
              />
            </div>
            <div class="flex justify-center">
              <Chart 
                :chart-data="sectorPortfolio.chartData"
                :chart-options="sectorPortfolio.chartOptions"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
