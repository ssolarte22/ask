<?php $basePath = $basePath ?? ''; ?>
<style id="a11y-critical">
  .a11y-widget,.a11y-backdrop{position:fixed;z-index:100000}
  .a11y-widget{right:max(1rem,env(safe-area-inset-right));bottom:max(1rem,env(safe-area-inset-bottom));pointer-events:none}
  .a11y-widget>*{pointer-events:auto}
  .a11y-fab{display:inline-flex;align-items:center;gap:.5rem;padding:.65rem 1rem .65rem .75rem;border-radius:999px;border:2px solid #fff;background:linear-gradient(135deg,#0b3d6d,#1f6fb2);color:#fff;font:600 .9rem system-ui,sans-serif;cursor:pointer;box-shadow:0 8px 28px rgba(11,61,109,.45)}
  .a11y-backdrop{inset:0;background:rgba(15,23,42,.45);opacity:0;visibility:hidden;transition:opacity .2s}
  .a11y-backdrop.is-visible{opacity:1;visibility:visible}
</style>
<script src="<?= App\Utils\Sanitizer::escape($basePath) ?>js/accessibility-init.js"></script>
