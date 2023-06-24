<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  wallets: {
    type: Array,
  },
})
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="flex justify-between mb-4">
            <div />
            <Link 
              :href="route('wallet.create')"
              method="get"
              as="button"
              class="p-2 bg-indigo-400 hover:bg-indigo-500 text-white rounded-md"
            >
              Adicionar carteira
            </Link>
          </div>
          <div>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              <div v-for="wallet in wallets" :key="wallet.id" class="w-72 md:w-56 xl:w-64 bg-white shadow rounded-lg mx-auto break-all border-2">
                <div class="font-medium h-24 p-2">{{ wallet.name }}</div>
                <Link 
                  :href="route('wallet.edit', wallet.id)"
                  method="get"
                  as="button"
                  class="w-full text-center p-1 bg-indigo-400 hover:bg-indigo-500 rounded-b-md text-white"
                >
                  Gerenciar
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
