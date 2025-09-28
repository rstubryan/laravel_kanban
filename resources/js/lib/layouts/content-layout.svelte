<script lang="ts">
    import type {Snippet} from "svelte";
    import { Toaster, toast } from "svelte-sonner";
    import { page } from "@inertiajs/svelte";

    let {children}: { children: Snippet } = $props();

    $effect(() => {
        const flash = $page.props.flash;
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
        if (flash?.info) toast.info(flash.info);
        if (flash?.warning) toast.warning(flash.warning);
    });
</script>

<div class="container mx-auto p-4">
    <Toaster position="top-center" richColors />
    {@render children()}
</div>
