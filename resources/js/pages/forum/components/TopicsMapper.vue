<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';

import {
    Card,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { MinimalTopic, ProfessionalArea } from '@/pages/forum/types';
import { show } from '@/routes/topics';
import { PaginatedResponse } from '@/types';

interface Props {
    topics: PaginatedResponse<MinimalTopic>;
    area: ProfessionalArea;
}

const { topics } = defineProps<Props>();
</script>

<template>
    <div v-for="topic in topics.data" :key="`topic-${topic.id}`">
        <Link
            :href="show.url({ topicId: topic.id, areaId: area.id })"
            class="block"
        >
            <Card
                class="cursor-pointer gap-2 overflow-hidden transition-colors hover:bg-muted/70"
            >
                <CardHeader>
                    <CardTitle>
                        <div class="flex flex-col justify-between gap-2">
                            <span>{{ topic.title }}</span>
                            <span class="text-xs italic">
                                {{ topic.user.name }}
                                <span
                                    class="text-sm font-normal text-foreground/70"
                                >
                                    {{ topic.user.email }}
                                </span>
                            </span>
                        </div>
                    </CardTitle>
                    <CardDescription class="truncate">
                        {{ topic.description }}
                    </CardDescription>
                </CardHeader>
            </Card>
        </Link>
    </div>
</template>
