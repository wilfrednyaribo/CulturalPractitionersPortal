@extends('layouts.admin')

@section('content')
<div class="fade-in" id="pdfArea">

    <!-- Header -->
    <div class="pract-header">
        <div>
            <div class="pract-eyebrow">Registry</div>
            <h1 class="pract-title">All Practitioners</h1>
            <p class="pract-desc">Manage registered cultural groups and individuals across all categories</p>
        </div>
        <div class="pract-actions">
            <button class="pract-btn-outline" onclick="downloadPractitionerPDF()" id="pdfBtn">
                <div class="pract-spinner"></div>
                <svg class="pract-pdf-icon" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><polyline points="9 15 12 18 15 15"/></svg>
                <span class="hidden sm:inline">Export PDF</span>
            </button>
            <a href="{{ route('practitioners.create') }}" class="pract-btn-gold">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span class="hidden sm:inline">Register New</span>
            </a>
        </div>
    </div>

    <!-- Ornamental Divider -->
    <div class="pract-ornament">
        <div class="pract-orn-line"></div>
        <div class="pract-orn-diamond"></div>
        <div class="pract-orn-line"></div>
    </div>

    <!-- Filter Bar -->
    <div class="pract-filter-bar">
        <div class="pract-filter-search">
            <svg width="15" height="15" fill="none" stroke="var(--ink-faint)" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" placeholder="Search by name, activity, county, or contact..." id="searchInput" onkeyup="searchTable(this.value)">
            <kbd style="font-size:9px; color:var(--ink-faint); background:var(--cream-warm); padding:2px 6px; border-radius:3px; font-family:'DM Sans',sans-serif; border:1px solid var(--border-classic);">/</kbd>
        </div>
        <div class="pract-filter-meta">
            <div class="pract-filter-chip">
                <svg width="12" height="12" fill="none" stroke="var(--gold)" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                <span id="totalChip">{{ $practitioners->count() }} records</span>
            </div>
            <div class="pract-filter-chip">
                <svg width="12" height="12" fill="none" stroke="var(--emerald)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ $practitioners->where('status', 'Active')->count() }} active</span>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="pract-panel">
        <div class="pract-panel-head">
            <div class="pract-panel-title-wrap">
                <div class="pract-panel-title">Cultural Practitioners Registry</div>
                <div class="pract-panel-subtitle">Complete listing of all registered practitioners</div>
            </div>
        </div>

        <div class="pract-table-wrap" style="overflow-x: auto;">
            @if($practitioners->isEmpty())
                <!-- Premium Empty State -->
                <div class="pract-empty">
                    <div class="pract-empty-icon">
                        <svg width="36" height="36" fill="none" stroke="var(--ink-faint)" stroke-width="1.2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                    </div>
                    <div class="pract-empty-title">No practitioners registered</div>
                    <div class="pract-empty-desc">Begin building your cultural registry by adding the first practitioner. This will activate all dashboard analytics and reporting features.</div>
                    <a href="{{ route('practitioners.create') }}" class="pract-btn-gold" style="margin-top: 8px;">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Register First Practitioner
                    </a>
                </div>
            @else
                <table class="pract-table" id="practitionerTable">
                    <thead>
                        <tr>
                            <th style="width: 36px;">#</th>
                            <th>Practitioner</th>
                            <th>Activity</th>
                            <th>County</th>
                            <th>Contact</th>
                            <th>Reg. Date</th>
                            <th>Renewal</th>
                            <th>Status</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($practitioners as $index => $p)
                            @php
                                $isExpired = $p->renewal_date && $p->renewal_date->isPast();
                                $isExpiringSoon = $p->renewal_date && $p->renewal_date->diffInDays(now()) <= 30 && !$p->renewal_date->isPast();
                                $badgeClass = $isExpired ? 'badge-expired' : ($p->status === 'Active' ? 'badge-active' : ($p->status === 'Suspended' ? 'badge-suspended' : 'badge-pending'));
                                $rowGlow = $isExpiringSoon ? 'row-expiring' : '';
                            @endphp
                            <tr class="pract-row {{ $rowGlow }}" data-searchable="{{ strtolower($p->name . ' ' . $p->activity . ' ' . $p->county . ' ' . $p->phone . ' ' . $p->email . ' ' . $p->status) }}">
                                <td>
                                    <span class="pract-row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="pract-name-cell">
                                        <div class="pract-avatar">
                                            {{ strtoupper(substr($p->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="pract-name-text">{{ $p->name }}</div>
                                            <div class="pract-name-sub">{{ $p->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="pract-activity">{{ $p->activity }}</span>
                                </td>
                                <td>
                                    <div class="pract-county-cell">
                                        <svg width="12" height="12" fill="none" stroke="var(--ink-faint)" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $p->county }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="pract-contact">{{ $p->phone }}</div>
                                </td>
                                <td>
                                    <div class="pract-date">{{ $p->registration_date ? $p->registration_date->format('d M Y') : '—' }}</div>
                                </td>
                                <td>
                                    @if($p->renewal_date)
                                    <div class="pract-date pract-date-renewal {{ $isExpired ? 'date-expired' : '' }} {{ $isExpiringSoon ? 'date-expiring' : '' }}">
                                        {{ $p->renewal_date->format('d M Y') }}
                                        @if($isExpiringSoon)
                                            <svg width="10" height="10" fill="none" stroke="var(--amber)" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                        @endif
                                    </div>
                                    @else
                                    <div class="pract-date" style="color: var(--ink-faint);">—</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $badgeClass }}">
                                        @if($isExpired) Expired @else {{ $p->status }} @endif
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <div class="pract-actions-cell">
                                        <a href="{{ route('practitioners.show', $p) }}" class="pract-action-btn" title="View Certificate">
                                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{ route('practitioners.edit', $p) }}" class="pract-action-btn pract-action-edit" title="Edit">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        </a>
                                        <div class="pract-action-divider"></div>
                                        <form method="POST" action="{{ route('practitioners.destroy', $p) }}" class="delete-form" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pract-action-btn pract-action-delete" title="Delete">
                                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- No Search Results -->
                <div class="pract-no-results" id="noResults">
                    <div style="width:48px;height:48px;border-radius:8px;background:var(--cream-warm);border:1px solid var(--border-classic);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <svg width="22" height="22" fill="none" stroke="var(--ink-faint)" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    <div class="pract-no-results-text">No matching practitioners found</div>
                    <div class="pract-no-results-sub">Try adjusting your search terms</div>
                </div>

                <!-- Table Footer -->
                <div class="pract-table-footer" id="tableFooter">
                    <div class="pract-footer-left">
                        Showing <strong id="visibleCount">{{ $practitioners->count() }}</strong> of <strong>{{ $practitioners->count() }}</strong> practitioner{{ $practitioners->count() !== 1 ? 's' : '' }}
                    </div>
                    <div class="pract-footer-right">
                        <span style="font-size:11px; color:var(--ink-faint); letter-spacing:0.3px;">All records loaded</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Stamp -->
    <div class="pract-footer-stamp">
        {{ env('COUNTY_NAME', 'Cultural Practitioners Registry') }} &mdash; Practitioner Listing &mdash; Generated {{ date('F j, Y') }}
    </div>

</div>

<!-- PDF Toast -->
<div class="pract-toast" id="pdfToast">
    <svg width="18" height="18" fill="none" stroke="var(--gold-light)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
    <span>Practitioner list exported successfully</span>
</div>

<!-- Delete Confirmation Modal -->
<div class="pract-modal-overlay" id="deleteModal">
    <div class="pract-modal">
        <div class="pract-modal-icon">
            <svg width="28" height="28" fill="none" stroke="var(--ruby)" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
        <div class="pract-modal-title">Confirm Deletion</div>
        <div class="pract-modal-desc">Are you sure you want to remove <strong id="deleteName"></strong> from the registry? This action cannot be undone.</div>
        <div class="pract-modal-actions">
            <button class="pract-btn-outline" onclick="closeDeleteModal()">Cancel</button>
            <button class="pract-btn-danger" id="confirmDeleteBtn" onclick="confirmDeleteAction()">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                Delete
            </button>
        </div>
    </div>
</div>

<style>
    :root {
        --gold: #b8860b;
        --gold-light: #daa520;
        --gold-pale: #f5ecd7;
        --gold-ghost: rgba(184,134,11,0.06);
        --ink: #1a1a1a;
        --ink-light: #3d3d3d;
        --ink-muted: #7a7a72;
        --ink-faint: #b0afa6;
        --cream: #faf8f4;
        --cream-warm: #f5f1ea;
        --cream-dark: #ece7dc;
        --parchment: #f0ebe0;
        --ivory: #fffff8;
        --border-classic: #e2ddd2;
        --border-light: #ede9e0;
        --emerald: #2d6a4f;
        --emerald-light: #40916c;
        --emerald-pale: #d8f3dc;
        --ruby: #9b2226;
        --ruby-pale: #fde8e8;
        --amber: #b45309;
        --amber-pale: #fef3c7;
        --sapphire: #1e40af;
        --sapphire-pale: #dbeafe;
    }

    /* ─── HEADER ─── */
    .pract-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 6px;
        gap: 20px;
    }
    .pract-eyebrow {
        font-size: 9px;
        font-weight: 700;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 6px;
    }
    .pract-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 28px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.1;
        margin-bottom: 6px;
    }
    .pract-desc {
        font-size: 13px;
        color: var(--ink-muted);
        font-weight: 400;
    }
    .pract-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        padding-top: 18px;
    }

    /* ─── BUTTONS ─── */
    .pract-btn-gold {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        color: #1a1a1a;
        border: none;
        border-radius: 4px;
        padding: 9px 20px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 8px rgba(184,134,11,0.25);
        font-family: 'DM Sans', sans-serif;
    }
    .pract-btn-gold:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(184,134,11,0.35); }
    .pract-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--ivory);
        color: var(--ink-light);
        border: 1px solid var(--border-classic);
        border-radius: 4px;
        padding: 9px 18px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        letter-spacing: 0.3px;
        font-family: 'DM Sans', sans-serif;
        position: relative;
    }
    .pract-btn-outline:hover { border-color: var(--gold); color: var(--gold); background: var(--gold-ghost); }
    .pract-btn-outline .pract-spinner {
        display: none;
        width: 14px;
        height: 14px;
        border: 2px solid var(--border-classic);
        border-top-color: var(--gold);
        border-radius: 50%;
        animation: pract-spin 0.6s linear infinite;
    }
    .pract-btn-outline.loading .pract-spinner { display: block; }
    .pract-btn-outline.loading .pract-pdf-icon { display: none; }
    .pract-btn-outline.loading { opacity: 0.7; pointer-events: none; }
    @keyframes pract-spin { to { transform: rotate(360deg); } }
    .pract-btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--ruby);
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 9px 20px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: 'DM Sans', sans-serif;
    }
    .pract-btn-danger:hover { background: #7f1d1d; }

    /* ─── ORNAMENT ─── */
    .pract-ornament {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }
    .pract-orn-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border-classic), transparent);
    }
    .pract-orn-diamond {
        width: 5px;
        height: 5px;
        background: var(--gold);
        transform: rotate(45deg);
        flex-shrink: 0;
    }

    /* ─── FILTER BAR ─── */
    .pract-filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .pract-filter-search {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--ivory);
        border: 1px solid var(--border-classic);
        border-radius: 4px;
        padding: 9px 14px;
        width: 380px;
        max-width: 100%;
        transition: all 0.25s ease;
    }
    .pract-filter-search:focus-within {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px var(--gold-ghost);
    }
    .pract-filter-search input {
        background: none;
        border: none;
        outline: none;
        font-size: 13px;
        color: var(--ink);
        width: 100%;
        font-family: 'DM Sans', sans-serif;
    }
    .pract-filter-search input::placeholder { color: var(--ink-faint); }
    .pract-filter-meta {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .pract-filter-chip {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 600;
        color: var(--ink-muted);
        background: var(--cream-warm);
        border: 1px solid var(--border-light);
        padding: 6px 12px;
        border-radius: 4px;
    }

    /* ─── PANEL ─── */
    .pract-panel {
        background: var(--ivory);
        border: 1px solid var(--border-classic);
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .pract-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 28px;
        border-bottom: 1px solid var(--border-light);
        background: linear-gradient(180deg, rgba(245,236,215,0.25), transparent);
    }
    .pract-panel-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--ink);
    }
    .pract-panel-subtitle {
        font-size: 11px;
        color: var(--ink-faint);
        margin-top: 2px;
        font-weight: 400;
    }

    /* ─── TABLE ─── */
    .pract-table {
        width: 100%;
        border-collapse: collapse;
    }
    .pract-table thead th {
        font-size: 9px;
        font-weight: 700;
        color: var(--ink-muted);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        text-align: left;
        padding: 14px 20px;
        background: var(--cream-warm);
        border-bottom: 1px solid var(--border-classic);
        white-space: nowrap;
    }
    .pract-table tbody td {
        font-size: 13px;
        color: var(--ink-light);
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-light);
        vertical-align: middle;
    }
    .pract-table tbody tr:last-child td { border-bottom: none; }
    .pract-table tbody tr { transition: background 0.15s ease; }
    .pract-table tbody tr:hover { background: var(--gold-ghost); }
    .pract-table tbody tr.row-expiring { background: rgba(180,83,9,0.03); }
    .pract-table tbody tr.row-expiring:hover { background: rgba(180,83,9,0.07); }

    /* ─── ROW NUMBER ─── */
    .pract-row-num {
        font-family: 'Playfair Display', serif;
        font-size: 11px;
        font-weight: 600;
        color: var(--ink-faint);
    }

    /* ─── NAME CELL ─── */
    .pract-name-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .pract-avatar {
        width: 36px;
        height: 36px;
        border-radius: 4px;
        background: var(--gold-pale);
        color: var(--gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
        font-family: 'Playfair Display', serif;
        border: 1px solid rgba(184,134,11,0.15);
    }
    .pract-name-text {
        font-weight: 600;
        color: var(--ink);
        font-size: 13px;
    }
    .pract-name-sub {
        font-size: 11px;
        color: var(--ink-faint);
        font-weight: 400;
        margin-top: 1px;
    }

    /* ─── ACTIVITY ─── */
    .pract-activity {
        font-size: 13px;
        color: var(--ink-light);
        background: var(--cream);
        padding: 3px 10px;
        border-radius: 3px;
        border: 1px solid var(--border-light);
        white-space: nowrap;
        display: inline-block;
    }

    /* ─── COUNTY CELL ─── */
    .pract-county-cell {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: var(--ink-light);
    }

    /* ─── CONTACT ─── */
    .pract-contact {
        font-size: 12px;
        color: var(--ink-muted);
        font-variant-numeric: tabular-nums;
    }

    /* ─── DATES ─── */
    .pract-date {
        font-size: 12px;
        color: var(--ink-muted);
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }
    .pract-date-renewal {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .date-expired { color: var(--ruby) !important; font-weight: 600; }
    .date-expiring { color: var(--amber) !important; font-weight: 600; }

    /* ─── STATUS BADGES ─── */
    .badge {
        display: inline-block;
        font-size: 9px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 3px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .badge-active { background: var(--emerald-pale); color: var(--emerald); }
    .badge-suspended { background: var(--ruby-pale); color: var(--ruby); }
    .badge-expired { background: var(--amber-pale); color: var(--amber); }
    .badge-pending { background: var(--sapphire-pale); color: var(--sapphire); }

    /* ─── ACTION BUTTONS ─── */
    .pract-actions-cell {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 2px;
    }
    .pract-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--ink-faint);
        transition: all 0.15s ease;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
    }
    .pract-action-btn:hover { background: var(--cream-warm); color: var(--ink); }
    .pract-action-edit:hover { background: var(--sapphire-pale); color: var(--sapphire); }
    .pract-action-delete:hover { background: var(--ruby-pale); color: var(--ruby); }
    .pract-action-divider {
        width: 1px;
        height: 18px;
        background: var(--border-light);
        margin: 0 4px;
    }

    /* ─── TABLE FOOTER ─── */
    .pract-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 28px;
        border-top: 1px solid var(--border-light);
        background: var(--cream);
        font-size: 12px;
        color: var(--ink-muted);
    }
    .pract-table-footer strong {
        color: var(--ink);
        font-family: 'Playfair Display', serif;
    }
    .pract-footer-right a,
    .pract-footer-right span {
        font-size: 12px;
        color: var(--ink-muted);
        text-decoration: none;
        padding: 4px 10px;
        border-radius: 3px;
        transition: all 0.15s ease;
        border: 1px solid transparent;
    }
    .pract-footer-right a:hover {
        color: var(--gold);
        border-color: var(--gold);
        background: var(--gold-ghost);
    }
    .pract-footer-right .active {
        color: var(--gold);
        border-color: var(--gold);
        background: var(--gold-pale);
        font-weight: 700;
    }

    /* ─── EMPTY STATE ─── */
    .pract-empty {
        padding: 72px 32px;
        text-align: center;
    }
    .pract-empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 12px;
        background: var(--cream-warm);
        border: 1px solid var(--border-classic);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .pract-empty-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .pract-empty-desc {
        font-size: 13px;
        color: var(--ink-muted);
        max-width: 400px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ─── NO RESULTS ─── */
    .pract-no-results {
        padding: 48px 24px;
        text-align: center;
        display: none;
    }
    .pract-no-results.show { display: block; }
    .pract-no-results-text {
        font-size: 14px;
        color: var(--ink-muted);
        font-weight: 600;
    }
    .pract-no-results-sub {
        font-size: 12px;
        color: var(--ink-faint);
        margin-top: 4px;
    }

    /* ─── FOOTER STAMP ─── */
    .pract-footer-stamp {
        text-align: center;
        padding: 16px 0 4px;
        color: var(--ink-faint);
        font-size: 9px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        font-weight: 600;
    }

    /* ─── TOAST ─── */
    .pract-toast {
        position: fixed;
        bottom: 32px;
        right: 32px;
        background: #1c1914;
        color: #f0ebe0;
        padding: 14px 24px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.25);
        border: 1px solid rgba(184,134,11,0.2);
        transform: translateY(120%);
        opacity: 0;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        z-index: 200;
    }
    .pract-toast.show { transform: translateY(0); opacity: 1; }

    /* ─── DELETE MODAL ─── */
    .pract-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 300;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .pract-modal-overlay.open { display: flex; }
    .pract-modal {
        background: var(--ivory);
        border: 1px solid var(--border-classic);
        border-radius: 8px;
        padding: 36px;
        max-width: 400px;
        width: 100%;
        text-align: center;
        box-shadow: 0 24px 64px rgba(0,0,0,0.2);
        animation: pract-modal-in 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes pract-modal-in {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .pract-modal-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--ruby-pale);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .pract-modal-title {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 10px;
    }
    .pract-modal-desc {
        font-size: 13px;
        color: var(--ink-muted);
        line-height: 1.6;
        margin-bottom: 28px;
    }
    .pract-modal-desc strong { color: var(--ink); }
    .pract-modal-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    /* ─── PRINT ─── */
    @media print {
        .pract-header, .pract-ornament, .pract-filter-bar, .pract-actions-cell,
        .pract-table-footer, .pract-footer-stamp, .pract-btn-outline, .pract-btn-gold,
        .pract-no-results { display: none !important; }
        .pract-panel { box-shadow: none !important; border: 1px solid #ddd !important; }
        .pract-table thead th { background: #f5f5f5 !important; }
        body { background: #fff !important; }
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
        .pract-header { flex-direction: column; gap: 16px; }
        .pract-actions { padding-top: 0; width: 100%; }
        .pract-actions .pract-btn-gold,
        .pract-actions .pract-btn-outline { flex: 1; justify-content: center; }
        .pract-filter-search { width: 100%; }
        .pract-filter-meta { width: 100%; }
        .pract-table-footer { flex-direction: column; gap: 12px; text-align: center; }
        .pract-title { font-size: 22px; }
    }
</style>

<script>
    // ─── ADVANCED SEARCH WITH LIVE COUNTER ───
    const totalCount = {{ $practitioners->count() }};

    function searchTable(query) {
        const table = document.getElementById('practitionerTable');
        const noResults = document.getElementById('noResults');
        const tableFooter = document.getElementById('tableFooter');
        const visibleCountEl = document.getElementById('visibleCount');
        if (!table) return;

        const rows = table.querySelectorAll('tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const searchable = (row.getAttribute('data-searchable') || row.innerText).toLowerCase();
            const match = searchable.includes(query.toLowerCase());
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        // Update visible count
        if (visibleCountEl) visibleCountEl.textContent = visibleCount;

        // Toggle no-results state
        if (query.length > 0 && visibleCount === 0) {
            noResults.classList.add('show');
            tableFooter.style.display = 'none';
            table.querySelector('thead').style.display = 'none';
        } else {
            noResults.classList.remove('show');
            tableFooter.style.display = '';
            table.querySelector('thead').style.display = '';
        }
    }

    // ─── KEYBOARD SHORTCUT ───
    document.addEventListener('keydown', function(e) {
        if (e.key === '/' && !['INPUT','TEXTAREA','SELECT'].includes(document.activeElement.tagName)) {
            e.preventDefault();
            const input = document.getElementById('searchInput');
            if (input) input.focus();
        }
        if (e.key === 'Escape') {
            closeDeleteModal();
            const input = document.getElementById('searchInput');
            if (input && document.activeElement === input) input.blur();
        }
    });

    // ─── DELETE MODAL (clean form interception) ───
    let pendingDeleteForm = null;

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                pendingDeleteForm = form;
                const name = form.closest('tr').querySelector('.pract-name-text').textContent;
                document.getElementById('deleteName').textContent = name;
                document.getElementById('deleteModal').classList.add('open');
            });
        });
    });

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('open');
        pendingDeleteForm = null;
    }

    function confirmDeleteAction() {
        if (pendingDeleteForm) {
            pendingDeleteForm.submit();
        }
    }

    // Close modal on overlay click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // ─── PDF EXPORT ───
    function downloadPractitionerPDF() {
        const btn = document.getElementById('pdfBtn');
        btn.classList.add('loading');

        const opt = {
            margin: [10, 8, 10, 8],
            filename: 'Practitioners-List-' + new Date().toISOString().slice(0,10) + '.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2,
                useCORS: true,
                backgroundColor: '#faf8f4',
                logging: false
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'landscape'
            },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        };

        html2pdf().set(opt).from(document.getElementById('pdfArea')).save().then(function() {
            btn.classList.remove('loading');
            showToast();
        }).catch(function() {
            btn.classList.remove('loading');
        });
    }

    function showToast() {
        const toast = document.getElementById('pdfToast');
        toast.classList.add('show');
        setTimeout(function() { toast.classList.remove('show'); }, 3500);
    }
</script>
@endsection