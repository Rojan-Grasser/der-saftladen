<script setup lang="ts">
import { ThumbsDownIcon, ThumbsUpIcon } from 'lucide-vue-next';
import { ref } from 'vue';

import { Button } from '@/components/ui/button';
import { Post } from '@/pages/forum/types';

type Reaction = 'like' | 'dislike';

const { post } = defineProps<{ post: Post }>();

const reaction = ref<Reaction | null>(post.reaction);

const changeReaction = (button: Reaction) => {
    if (reaction.value === button) {
        return;
    }
    // run post
};
</script>

<template>
    <div
        class="inline-flex w-fit -space-x-px rounded-md shadow-xs rtl:space-x-reverse"
    >
        <Button
            variant="outline"
            class="group w-20 justify-start gap-3 overflow-hidden rounded-none rounded-l-md shadow-none transition-all duration-200 not-hover:w-10 hover:bg-lime-500/10 hover:text-lime-500 focus-visible:z-10 dark:hover:bg-lime-400/10 dark:hover:text-lime-400"
        >
            <ThumbsUpIcon
                :class="
                    reaction === 'like' && 'text-lime-500 dark:text-lime-400'
                "
            />
            Like
        </Button>
        <Button
            variant="outline"
            class="group w-24.5 justify-end gap-3 overflow-hidden rounded-none rounded-r-md shadow-none transition-all duration-200 not-hover:w-10 hover:bg-destructive/10! hover:text-destructive focus-visible:z-10"
        >
            Dislike
            <ThumbsDownIcon
                :class="reaction === 'dislike' && 'text-destructive'"
            />
        </Button>
    </div>
</template>

<style scoped></style>
