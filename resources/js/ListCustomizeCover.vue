<template>
    <div ref="page" class="bg-white">
        <div>
            <notifications position="bottom right" />
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div v-for="item in covers" :key="item">{{ item }}</div>
            </main>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";

const covers = ref([]);

function getCustomizeCovers() {
    fetch("/api/get-customize-covers", { method: "GET" }).then(async function (
        res
    ) {
        const response = await res.json();
        covers.value = response.files;
    });
}

onMounted(() => {
    getCustomizeCovers();
});
</script>
<style scoped></style>
