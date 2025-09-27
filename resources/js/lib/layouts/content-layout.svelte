<script lang="ts">
    import type {Snippet} from "svelte";

    let {children}: { children: Snippet } = $props();

</script>

<div class="container mx-auto p-4">
    {@render children()}
</div>
