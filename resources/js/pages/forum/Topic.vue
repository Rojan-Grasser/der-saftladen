<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import PostsMapper from '@/pages/forum/components/PostsMapper.vue';
import TopicPost from '@/pages/forum/components/TopicPost.vue';
import { ProfessionalArea, Topic } from '@/pages/forum/types';
import { areas } from '@/routes/forum';
import { show, index as topicIndex } from '@/routes/topics';
import { BreadcrumbItem } from '@/types';


const { topic, area } = defineProps<{ area: ProfessionalArea; topic: Topic }>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Berufsbereiche',
        href: areas().url,
    },
    {
        title: area.name,
        href: topicIndex({ areaId: area.id }).url,
    },
    {
        title: topic.title,
        href: show.url({ topicId: topic.id, areaId: area.id }),
    },
];
</script>

<template>
    <Head :title="topic.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-10 pt-4">
            <TopicPost :topic="topic" class="mb-10" :area-id="area.id" />

            <PostsMapper :posts="topic.posts" :topicId="topic.id" />
        </div>
    </AppLayout>
</template>
