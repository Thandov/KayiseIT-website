<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { ChevronDown, Menu, X } from 'lucide-vue-next';
import {
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuPortal,
    DropdownMenuRoot,
    DropdownMenuTrigger,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuRoot,
    NavigationMenuTrigger,
} from 'reka-ui';
import { cn } from '@/lib/utils';

const props = defineProps({
    menuItems: { type: Array, default: () => [] },
    routes: { type: Object, required: true },
    activeRoutes: { type: Object, default: () => ({}) },
    auth: { type: Object, default: null },
    labels: { type: Object, required: true },
    isHomePage: { type: Boolean, default: false },
    hasCertification: { type: Boolean, default: false },
    logoUrl: { type: String, required: true },
});

const mobileOpen = ref(false);
const navbarRef = ref(null);

const navTriggerClass = cn(
    'group inline-flex h-9 w-max items-center justify-center rounded-md px-3 py-2 text-sm font-medium transition-colors',
    'text-white/90 hover:bg-white/10 hover:text-white',
    'focus:bg-white/10 focus:text-white focus:outline-none',
    'data-[state=open]:bg-white/10 data-[state=open]:text-white',
);

const navLinkClass = (active) =>
    cn(
        'inline-flex h-9 items-center rounded-md px-3 py-2 text-sm font-medium transition-colors whitespace-nowrap',
        active ? 'text-white font-semibold' : 'text-white/90 hover:text-white hover:bg-white/10',
    );

const isActive = (key) => Boolean(props.activeRoutes?.[key]);

const userInitial = computed(() => (props.auth?.name ? props.auth.name.charAt(0).toUpperCase() : ''));

const linkTarget = (item) => (item.openInNewTab ? '_blank' : undefined);
const linkRel = (item) => (item.openInNewTab ? 'noopener noreferrer' : undefined);

function closeMobile() {
    mobileOpen.value = false;
}

let lastScrollY = 0;
let ticking = false;

function handleScroll() {
    const navbar = navbarRef.value;
    if (!navbar) return;

    const currentScrollY = window.scrollY || 0;
    const scrollingDown = currentScrollY > lastScrollY;

    if (props.isHomePage && currentScrollY > 100 && scrollingDown && !mobileOpen.value) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.opacity = '0';
        navbar.style.pointerEvents = 'none';
    } else {
        navbar.style.transform = 'translateY(0)';
        navbar.style.opacity = '1';
        navbar.style.pointerEvents = 'auto';
    }

    lastScrollY = currentScrollY;
}

const onScroll = () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            handleScroll();
            ticking = false;
        });
        ticking = true;
    }
};

onMounted(() => {
    window.addEventListener('scroll', onScroll, { passive: true });
    handleScroll();
});

onUnmounted(() => {
    window.removeEventListener('scroll', onScroll);
});
</script>

<template>
    <nav
        id="main-navbar"
        ref="navbarRef"
        class="site-navbar-shadcn fixed top-0 left-0 right-0 z-50 bg-black/95 backdrop-blur-lg border-b border-white/10 transition-all duration-300"
        style="transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between gap-4">
                <a :href="routes.home" class="shrink-0">
                    <img :src="logoUrl" alt="KAYISE IT" class="h-8 w-auto brightness-0 invert" />
                </a>

                <div class="hidden lg:flex flex-1 items-center justify-end gap-1 min-w-0">
                    <NavigationMenuRoot :viewport="false" class="relative flex max-w-max flex-1 items-center justify-end">
                        <NavigationMenuList class="flex flex-1 list-none items-center justify-end gap-0.5">
                            <template v-for="item in menuItems" :key="item.activeKey || item.label">
                                <NavigationMenuItem v-if="item.type === 'link'">
                                    <a
                                        :href="item.href"
                                        :target="linkTarget(item)"
                                        :rel="linkRel(item)"
                                        :class="navLinkClass(isActive(item.activeKey))"
                                    >
                                        {{ item.label }}
                                    </a>
                                </NavigationMenuItem>

                                <NavigationMenuItem v-else-if="item.type === 'dropdown'">
                                    <NavigationMenuTrigger :class="cn(navTriggerClass, isActive(item.activeKey) && 'text-white font-semibold')">
                                        {{ item.label }}
                                    </NavigationMenuTrigger>
                                    <NavigationMenuContent
                                        class="absolute top-full left-0 z-50 mt-1.5 w-auto overflow-hidden rounded-md border border-border bg-popover p-2 text-popover-foreground shadow-lg data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95"
                                    >
                                        <ul class="grid w-[260px] gap-0.5">
                                            <li v-for="child in item.children" :key="child.activeKey || child.label">
                                                <NavigationMenuLink as-child>
                                                    <a
                                                        :href="child.href"
                                                        :target="linkTarget(child)"
                                                        :rel="linkRel(child)"
                                                        :class="cn(
                                                            'block rounded-md px-3 py-2.5 text-sm transition-colors',
                                                            isActive(child.activeKey)
                                                                ? 'bg-accent font-semibold text-accent-foreground'
                                                                : 'text-popover-foreground hover:bg-accent hover:text-accent-foreground',
                                                        )"
                                                    >
                                                        {{ child.label }}
                                                    </a>
                                                </NavigationMenuLink>
                                            </li>
                                        </ul>
                                    </NavigationMenuContent>
                                </NavigationMenuItem>

                                <NavigationMenuItem v-else-if="item.type === 'certification'">
                                    <a
                                        :href="item.href"
                                        :title="item.title"
                                        :target="linkTarget(item)"
                                        :rel="linkRel(item)"
                                        :class="cn(
                                            'inline-flex h-9 items-center gap-1.5 rounded-md px-3 text-sm font-bold whitespace-nowrap transition-colors',
                                            isActive(item.activeKey)
                                                ? 'bg-amber-400 text-gray-900 ring-2 ring-white/80'
                                                : 'bg-amber-500 text-gray-900 hover:bg-amber-400 shadow-sm',
                                        )"
                                    >
                                        <span>{{ item.label }}</span>
                                        <span
                                            v-if="item.badge"
                                            class="rounded bg-gray-900 px-1.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wide text-amber-300"
                                        >
                                            {{ item.badge }}
                                        </span>
                                    </a>
                                </NavigationMenuItem>
                            </template>
                        </NavigationMenuList>
                    </NavigationMenuRoot>

                    <template v-if="!auth">
                        <a
                            v-if="routes.login"
                            :href="routes.login"
                            class="ml-2 text-sm font-medium text-white/90 hover:text-white whitespace-nowrap"
                        >
                            {{ labels.login }}
                        </a>
                        <a
                            v-if="routes.register"
                            :href="routes.register"
                            class="ml-2 inline-flex h-9 items-center rounded-lg bg-white/20 px-4 text-sm font-medium text-white hover:bg-white/30 whitespace-nowrap"
                        >
                            {{ labels.register }}
                        </a>
                    </template>

                    <DropdownMenuRoot v-else>
                        <DropdownMenuTrigger
                            class="ml-2 inline-flex h-9 items-center gap-2 rounded-md px-2 text-sm font-medium text-white/90 hover:bg-white/10 hover:text-white focus:outline-none"
                        >
                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-sm font-semibold text-white"
                            >
                                {{ userInitial }}
                            </span>
                            <span class="max-w-[120px] truncate">{{ auth.name }}</span>
                            <ChevronDown class="h-4 w-4 opacity-70" />
                        </DropdownMenuTrigger>
                        <DropdownMenuPortal>
                            <DropdownMenuContent
                                :side-offset="8"
                                class="z-[60] min-w-[12rem] overflow-hidden rounded-md border border-border bg-popover p-1 text-popover-foreground shadow-md"
                            >
                                <DropdownMenuItem v-if="auth.isAdmin" as-child>
                                    <a
                                        :href="routes.dashboard"
                                        class="relative flex cursor-pointer select-none items-center rounded-sm px-2 py-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground"
                                    >
                                        {{ labels.dashboard }}
                                    </a>
                                </DropdownMenuItem>
                                <DropdownMenuItem v-if="auth.isStudent" as-child>
                                    <a
                                        :href="routes.studentPortal"
                                        class="relative flex cursor-pointer select-none items-center rounded-sm px-2 py-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground"
                                    >
                                        {{ labels.studentPortal }}
                                    </a>
                                </DropdownMenuItem>
                                <DropdownMenuItem as-child>
                                    <a
                                        :href="routes.profile"
                                        class="relative flex cursor-pointer select-none items-center rounded-sm px-2 py-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground"
                                    >
                                        {{ labels.profile }}
                                    </a>
                                </DropdownMenuItem>
                                <DropdownMenuItem as-child>
                                    <form :action="routes.logout" method="POST" class="w-full">
                                        <input type="hidden" name="_token" :value="auth.csrfToken" />
                                        <button
                                            type="submit"
                                            class="relative flex w-full cursor-pointer select-none items-center rounded-sm px-2 py-2 text-left text-sm outline-none hover:bg-accent hover:text-accent-foreground"
                                        >
                                            {{ labels.logout }}
                                        </button>
                                    </form>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenuPortal>
                    </DropdownMenuRoot>
                </div>

                <button
                    type="button"
                    class="lg:hidden inline-flex items-center justify-center rounded-md p-2 text-white/90 hover:bg-white/10 hover:text-white"
                    :aria-expanded="mobileOpen"
                    aria-label="Toggle menu"
                    @click="mobileOpen = !mobileOpen"
                >
                    <Menu v-if="!mobileOpen" class="h-6 w-6" />
                    <X v-else class="h-6 w-6" />
                </button>
            </div>
        </div>

        <div
            v-show="mobileOpen"
            class="lg:hidden border-t border-white/15 bg-black/98 backdrop-blur-md"
        >
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
                <template v-for="item in menuItems" :key="'m-' + (item.activeKey || item.label)">
                    <template v-if="item.type === 'link' || item.type === 'certification'">
                        <a
                            :href="item.href"
                            :title="item.title"
                            :target="linkTarget(item)"
                            :rel="linkRel(item)"
                            :class="cn(
                                'block w-full',
                                item.type === 'certification'
                                    ? 'mt-2 flex items-center justify-between gap-2 rounded-lg bg-amber-500 px-3 py-2.5 text-base font-bold text-gray-900'
                                    : navLinkClass(isActive(item.activeKey)),
                            )"
                            @click="closeMobile"
                        >
                            <span>{{ item.label }}</span>
                            <span
                                v-if="item.type === 'certification' && item.badge"
                                class="shrink-0 rounded bg-gray-900 px-2 py-0.5 text-[10px] font-extrabold uppercase text-amber-300"
                            >
                                {{ item.badge }}
                            </span>
                        </a>
                    </template>

                    <template v-else-if="item.type === 'dropdown'">
                        <p class="px-3 pt-3 pb-1 text-xs font-semibold uppercase tracking-wider text-white/50">
                            {{ item.label }}
                        </p>
                        <a
                            v-for="child in item.children"
                            :key="child.activeKey || child.label"
                            :href="child.href"
                            :target="linkTarget(child)"
                            :rel="linkRel(child)"
                            :class="navLinkClass(isActive(child.activeKey))"
                            class="block w-full pl-6"
                            @click="closeMobile"
                        >
                            {{ child.label }}
                        </a>
                    </template>
                </template>

                <template v-if="!auth">
                    <a
                        v-if="routes.login"
                        :href="routes.login"
                        class="block px-3 py-2 text-sm font-medium text-white/90"
                        @click="closeMobile"
                    >
                        {{ labels.login }}
                    </a>
                    <a
                        v-if="routes.register"
                        :href="routes.register"
                        class="block rounded-lg bg-white/20 px-3 py-2 text-center text-sm font-medium text-white"
                        @click="closeMobile"
                    >
                        {{ labels.register }}
                    </a>
                </template>

                <div v-else class="border-t border-white/15 pt-3 mt-3 space-y-1">
                    <a
                        v-if="auth.isAdmin"
                        :href="routes.dashboard"
                        class="block px-3 py-2 text-sm text-white/90"
                        @click="closeMobile"
                    >
                        {{ labels.dashboard }}
                    </a>
                    <a
                        v-if="auth.isStudent"
                        :href="routes.studentPortal"
                        class="block px-3 py-2 text-sm text-white/90"
                        @click="closeMobile"
                    >
                        {{ labels.studentPortal }}
                    </a>
                    <a :href="routes.profile" class="block px-3 py-2 text-sm text-white/90" @click="closeMobile">
                        {{ labels.profile }}
                    </a>
                    <form :action="routes.logout" method="POST">
                        <input type="hidden" name="_token" :value="auth.csrfToken" />
                        <button type="submit" class="block w-full px-3 py-2 text-left text-sm text-white/90">
                            {{ labels.logout }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</template>
