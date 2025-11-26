<div class="sidebar-inner">
  <div class="sidebar-logo mb-3 d-flex justify-content-end ">
    <div class="mt-auto w-100 d-flex justify-content-center">
        <img src="<?= base_url('assetdashboard/sidebar/Layer_1.svg') ?>" alt="Sidebar Logo" style="max-width:90%;height:auto;">
    </div>
  </div>
  <ul class="nav nav-pills flex-column sidebar-tabs" id="dashboardMainTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link d-flex align-items-center px-3 py-2 <?= ($activeTab??'dashboard')==='dashboard'?'active':'' ?>" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="<?= ($activeTab??'dashboard')==='dashboard'?'true':'false' ?>">
        <span class="icon me-3" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke-width="0" xmlns="http://www.w3.org/2000/svg"><path d="M3 13H11V3H3V13ZM3 21H11V15H3V21ZM13 21H21V11H13V21ZM13 3V9H21V3H13Z" fill="currentColor"/></svg>
        </span>Dashboard
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link d-flex align-items-center px-3 py-2 <?= ($activeTab??'dashboard')==='athletes'?'active':'' ?>" id="athletes-tab" data-bs-toggle="tab" data-bs-target="#athletes" type="button" role="tab" aria-controls="athletes" aria-selected="<?= ($activeTab??'dashboard')==='athletes'?'true':'false' ?>">
        <span class="icon me-3" aria-hidden="true">
          <svg width="24" height="22" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.7868 11C19.6247 11 21.0972 9.66 21.0972 8C21.0972 6.34 19.6247 5 17.7868 5C15.949 5 14.4654 6.34 14.4654 8C14.4654 9.66 15.949 11 17.7868 11ZM8.92969 11C10.7675 11 12.24 9.66 12.24 8C12.24 6.34 10.7675 5 8.92969 5C7.09183 5 5.60826 6.34 5.60826 8C5.60826 9.66 7.09183 11 8.92969 11ZM8.92969 13C6.35005 13 1.17969 14.17 1.17969 16.5V19H16.6797V16.5C16.6797 14.17 11.5093 13 8.92969 13ZM17.7868 13C17.4658 13 17.1004 13.02 16.7129 13.05C17.9972 13.89 18.894 15.02 18.894 16.5V19H25.5368V16.5C25.5368 14.17 20.3665 13 17.7868 13Z" fill="currentColor"/></svg>
        </span>Athletes
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link d-flex align-items-center px-3 py-2 <?= ($activeTab??'dashboard')==='parents'?'active':'' ?>" id="parents-tab" data-bs-toggle="tab" data-bs-target="#parents" type="button" role="tab" aria-controls="parents" aria-selected="<?= ($activeTab??'dashboard')==='parents'?'true':'false' ?>">
        <span class="icon me-3" aria-hidden="true">
          <svg width="22" height="18" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.15617 14.9858C9.1558 15.3403 9.25771 15.6892 9.45243 16H2.07385C1.62776 15.9991 1.20023 15.8435 0.884794 15.5674C0.569355 15.2912 0.391678 14.9169 0.390625 14.5263V12.3164C0.39378 11.3403 0.838072 10.4049 1.62643 9.71471C2.41479 9.02449 3.48313 8.63551 4.59803 8.63274H11.8756C12.0297 9.08393 12.2809 9.50518 12.6156 9.8738C11.6484 10.0193 10.7709 10.4593 10.138 11.116C9.50504 11.7727 9.15733 12.604 9.15617 13.4632V14.9858ZM8.3843 7.52777C7.53402 7.52777 6.70284 7.30702 5.99586 6.89344C5.28888 6.47986 4.73786 5.89202 4.41247 5.20426C4.08709 4.5165 4.00195 3.75971 4.16783 3.02959C4.33371 2.29947 4.74316 1.62881 5.3444 1.10242C5.94563 0.576029 6.71165 0.217554 7.54559 0.0723237C8.37953 -0.0729067 9.24393 0.00163093 10.0295 0.286511C10.815 0.57139 11.4865 1.05382 11.9589 1.67278C12.4312 2.29175 12.6834 3.01946 12.6834 3.76389C12.6834 4.76213 12.2304 5.71949 11.4242 6.42536C10.618 7.13122 9.52449 7.52777 8.3843 7.52777ZM21.4263 14.9858C21.4253 15.2545 21.3029 15.5119 21.0859 15.7019C20.8688 15.8919 20.5748 15.9991 20.2679 16H11.5767C11.2698 15.9991 10.9758 15.8919 10.7587 15.7019C10.5417 15.5119 10.4193 15.2545 10.4183 14.9858V13.4632C10.4207 12.7914 10.7266 12.1477 11.2692 11.6726C11.8118 11.1976 12.5471 10.9297 13.3144 10.9276H18.5288C19.2962 10.9297 20.0314 11.1976 20.574 11.6726C21.1166 12.1477 21.4226 12.7914 21.425 13.4632L21.4263 14.9858ZM18.8822 7.5743C18.8822 8.08684 18.7086 8.58787 18.3834 9.01403C18.0582 9.44019 17.5959 9.77234 17.055 9.96849C16.5142 10.1646 15.919 10.2159 15.3448 10.116C14.7707 10.016 14.2433 9.76915 13.8293 9.40673C13.4154 9.04431 13.1334 8.58256 13.0192 8.07986C12.905 7.57717 12.9636 7.05612 13.1877 6.58259C13.4117 6.10907 13.7911 5.70434 14.2778 5.41958C14.7646 5.13483 15.3369 4.98285 15.9223 4.98285C16.7073 4.98285 17.4602 5.25587 18.0153 5.74186C18.5704 6.22786 18.8822 6.887 18.8822 7.5743Z" fill="currentColor"/></svg>
        </span>Parents/Guardians
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link d-flex align-items-center px-3 py-2 <?= ($activeTab??'dashboard')==='waivers'?'active':'' ?>" id="waivers-tab" data-bs-toggle="tab" data-bs-target="#waivers" type="button" role="tab" aria-controls="waivers" aria-selected="<?= ($activeTab??'dashboard')==='waivers'?'true':'false' ?>">
        <span class="icon me-3" aria-hidden="true">
          <svg width="24" height="22" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.1049 3H16.4771C16.0121 1.84 14.7942 1 13.3549 1C11.9156 1 10.6978 1.84 10.2328 3H5.60491C4.38705 3 3.39062 3.9 3.39062 5V19C3.39062 20.1 4.38705 21 5.60491 21H21.1049C22.3228 21 23.3192 20.1 23.3192 19V5C23.3192 3.9 22.3228 3 21.1049 3ZM13.3549 3C13.9638 3 14.4621 3.45 14.4621 4C14.4621 4.55 13.9638 5 13.3549 5C12.746 5 12.2478 4.55 12.2478 4C12.2478 3.45 12.746 3 13.3549 3ZM15.5692 17H7.8192V15H15.5692V17ZM18.8906 13H7.8192V11H18.8906V13ZM18.8906 9H7.8192V7H18.8906V9Z" fill="currentColor"/></svg>
        </span>Waivers
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link d-flex align-items-center px-3 py-2 <?= ($activeTab??'dashboard')==='calendar'?'active':'' ?>" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar" type="button" role="tab" aria-controls="calendar" aria-selected="<?= ($activeTab??'dashboard')==='calendar'?'true':'false' ?>">
        <span class="icon me-3" aria-hidden="true">
          <svg width="24" height="22" viewBox="0 0 29 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.4469 12.75H15.3594V17.25H20.4469V12.75ZM18.7511 3V4.5H10.2719V3H7.72814V4.5H6.45573C5.28974 4.5 4.33594 5.34366 4.33594 6.375V19.125C4.33594 20.1563 5.28974 21 6.45573 21H22.5667C23.7327 21 24.6865 20.1563 24.6865 19.125V6.375C24.6865 5.34366 23.7327 4.5 22.5667 4.5H21.2948V3H18.7511ZM22.5667 19.125H6.45573V9.1875H22.5667V19.125Z" fill="currentColor"/></svg>
        </span>Qualifiers Calendar
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link d-flex align-items-center px-3 py-2 <?= ($activeTab??'dashboard')==='help'?'active':'' ?>" id="help-tab" data-bs-toggle="tab" data-bs-target="#help" type="button" role="tab" aria-controls="help" aria-selected="<?= ($activeTab??'dashboard')==='help'?'true':'false' ?>">
        <span class="icon me-3" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.5469 19.7461H10.4531V16.6992H13.5469V19.7461ZM13.5 15.1523H10.5C10.5 10.418 15 10.6945 15 7.69922C15 6.04922 13.65 4.72734 12 4.72734C10.35 4.72734 9 6.15234 9 7.74609H6C6 4.41797 8.68594 1.74609 12 1.74609C15.3141 1.74609 18 4.38984 18 7.69922C18 11.4445 13.5 11.8711 13.5 15.1523Z" fill="currentColor"/></svg>
        </span>Help
      </button>
    </li>
  </ul>
  
</div>
