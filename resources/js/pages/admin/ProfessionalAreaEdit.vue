<script lang="ts" setup>
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import admin from '@/routes/admin';
import { type ProfessionalArea } from '@/types';

const open = defineModel<boolean>('open', { required: true });

const props = defineProps<{
    professionalArea: ProfessionalArea;
}>();

const emit = defineEmits<{
    (e: 'updated'): void;
}>();

const form = useForm({
    name: props.professionalArea.name,
    description: props.professionalArea.description,
});

watch(
    () => props.professionalArea,
    (u) => {
        form.name = u.name;
        form.description = u.description;
        form.clearErrors();
    },
    { immediate: true },
);

function close() {
    open.value = false;
    form.reset();
    form.clearErrors();
}

const submit = () => {
    form.put(admin.professionalArea.update(props.professionalArea.id).url, {
        onSuccess: () => {
            emit('updated');
            close();
        },
        preserveScroll: true,
    });
};
</script>

<template>
    <Dialog :open="open" @update:open="(v) => (v ? (open = true) : close())">
        <DialogContent class="sm:max-w-106.25">
            <DialogHeader>
                <DialogTitle>Edit User</DialogTitle>
                <DialogDescription>
                    Update the user's profile information and permissions.
                </DialogDescription>
            </DialogHeader>

            <form class="space-y-4" @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="name">Name</Label>
                    <Input id="name" v-model="form.name" />
                    <div v-if="form.errors.name" class="text-sm text-red-600">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="description">Description</Label>
                    <Input id="description" v-model="form.description" />
                    <div
                        v-if="form.errors.description"
                        class="text-sm text-red-600"
                    >
                        {{ form.errors.description }}
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <Button
                        :disabled="form.processing"
                        type="button"
                        variant="outline"
                        @click="close"
                    >
                        Abbrechen
                    </Button>
                    <Button :disabled="form.processing" type="submit">
                        Speichern
                    </Button>
                </div>
            </form>
        </DialogContent>
    </Dialog>
</template>
