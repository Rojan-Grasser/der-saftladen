<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import CreateTopic from '@/pages/forum/components/CreateTopic.vue';
import TopicsMapper from '@/pages/forum/components/TopicsMapper.vue';
import { MinimalTopic, ProfessionalArea } from '@/pages/forum/types';
import { areas } from '@/routes/forum';
import { index as topicIndex } from '@/routes/topics';
import { BreadcrumbItem, PaginatedResponse } from '@/types';

type Props = {
    topics: PaginatedResponse<MinimalTopic>;
    area: ProfessionalArea;
};

// Todo: The actual topic type is not in the actual props
const { area, topics } = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Berufsbereiche',
        href: areas().url,
    },
    {
        title: area.name,
        href: topicIndex({ areaId: area.id }).url,
    },
];
</script>

<template>
    <Head title="Forum Themen" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-3 p-5">
            <div>
                <CreateTopic :area-id="area.id" />
            </div>
            <TopicsMapper :topics="topics" :area="area" />
        </div>
    </AppLayout>
</template>
