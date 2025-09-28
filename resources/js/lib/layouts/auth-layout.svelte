<script lang="ts">
    import type { Snippet } from 'svelte';
    import {page} from "@inertiajs/svelte";
    import {toast} from "svelte-sonner";
    import {Toaster} from "$lib/components/ui/sonner";

    let { children }: { children: Snippet } = $props();

    $effect(() => {
        const flash = $page.props.flash;
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
        if (flash?.info) toast.info(flash.info);
        if (flash?.warning) toast.warning(flash.warning);
    });
</script>

<div class="min-h-screen flex items-center justify-center">
    <Toaster position="top-center" richColors />
    {@render children()}
</div>
