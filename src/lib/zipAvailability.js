const ZIP_RULES = [
  {
    label: 'Altoona',
    status: 'daily',
    summary: 'Daily pickup and delivery is available for Altoona-area ZIP codes and nearby routes.',
    match: (zip) => ['16601', '16602', '16603', '16611'].includes(zip),
  },
  {
    label: 'State College',
    status: 'daily',
    summary: 'Daily service is available for State College-area ZIP codes and nearby student routes.',
    match: (zip) => ['16801', '16802', '16803', '16804', '16805'].includes(zip),
  },
  {
    label: 'Lock Haven',
    status: 'weekly',
    summary: 'Weekly route service is available for Lock Haven-area ZIP codes.',
    match: (zip) => ['17745', '17739', '17740'].includes(zip),
  },
  {
    label: 'Route-Based',
    status: 'route',
    summary: 'Your ZIP code is outside the core daily service zones, but we may still offer route-based pickup and delivery based on schedule and demand.',
    match: (zip) => zip.startsWith('16') || zip.startsWith('17') || zip.startsWith('15'),
  },
];

export function getZipAvailability(rawZip) {
  const normalized = String(rawZip ?? '').trim();

  if (!/^\d{5}$/.test(normalized)) {
    return {
      status: 'invalid',
      summary: 'Please enter a valid 5-digit ZIP code so we can check availability.',
      label: 'Check needed',
    };
  }

  const zip = normalized;
  const match = ZIP_RULES.find((rule) => rule.match(zip));

  if (!match) {
    return {
      status: 'route',
      summary: 'We do not currently advertise daily coverage for that ZIP code, but route-based pickup may still be available. Please request pickup to confirm.',
      label: 'Route-based',
    };
  }

  return {
    status: match.status,
    summary: match.summary,
    label: match.label,
  };
}
