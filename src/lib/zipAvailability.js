export const SERVICE_AREA_GROUPS = [
  { region: 'Active service', status: 'active', areas: [['Altoona', '16601, 16602'], ['State College', '16801, 16802, 16803']] },
  { region: 'Weekly route', status: 'weekly', areas: [['Lock Haven', '17745']] },
  { region: 'Centre County route-based', status: 'route', areas: [['Bellefonte', '16823'], ['Boalsburg', '16827'], ['Lemont', '16851'], ['Milesburg', '16853'], ['Pine Grove Mills', '16868'], ['Port Matilda', '16870'], ['Pennsylvania Furnace', '16865'], ['Warriors Mark', '16877']] },
  { region: 'Blair County route-based', status: 'route', areas: [['Tyrone', '16686'], ['Duncansville', '16635'], ['Hollidaysburg', '16648'], ['Bellwood', '16617'], ['Roaring Spring', '16673'], ['Martinsburg', '16662'], ['Claysburg', '16625'], ['Newry', '16665'], ['Gallitzin', '16641'], ['Cresson', '16630'], ['Williamsburg', '16693']] },
  { region: 'Expansion / Lock Haven cluster', status: 'route', areas: [['Huntingdon', '16652'], ['Castanea', '17726'], ['McElhattan', '17748'], ['Mill Hall', '17751']] },
];

const ACTIVE = { '16601': 'Altoona', '16602': 'Altoona', '16801': 'State College', '16802': 'State College', '16803': 'State College' };
const ROUTE_BASED = { '16823': 'Bellefonte', '16827': 'Boalsburg', '16851': 'Lemont', '16853': 'Milesburg', '16865': 'Pennsylvania Furnace', '16868': 'Pine Grove Mills', '16870': 'Port Matilda', '16877': 'Warriors Mark', '16686': 'Tyrone', '16635': 'Duncansville', '16648': 'Hollidaysburg', '16617': 'Bellwood', '16673': 'Roaring Spring', '16662': 'Martinsburg', '16625': 'Claysburg', '16665': 'Newry', '16641': 'Gallitzin', '16630': 'Cresson', '16693': 'Williamsburg', '16652': 'Huntingdon', '17726': 'Castanea', '17748': 'McElhattan', '17751': 'Mill Hall' };
const PO_BOX = new Set(['16603', '16804', '16805']);

export function getZipAvailability(rawZip) {
  const zip = String(rawZip ?? '').trim();
  if (!/^\d{5}$/.test(zip)) {
    return {
      status: 'invalid',
      summary: 'Please enter a valid 5-digit ZIP code so we can check availability.',
      label: 'Check needed',
    };
  }

  if (PO_BOX.has(zip)) return { status: 'waitlist', label: 'Physical address needed', summary: 'This is a P.O. Box ZIP and cannot be used as a pickup address. Please enter the physical pickup-address ZIP instead.' };
  if (ACTIVE[zip]) return { status: 'active', label: `${ACTIVE[zip]} — active service`, summary: `${ACTIVE[zip]} is an active service area. Continue to booking and we’ll confirm your pickup window.` };
  if (zip === '17745') return { status: 'weekly', label: 'Lock Haven — weekly route', summary: 'Lock Haven is served by weekly route. Continue to booking and we’ll confirm the next route availability.' };
  if (ROUTE_BASED[zip]) return { status: 'route', label: `${ROUTE_BASED[zip]} — route-based`, summary: 'This area is route-based. Send your request and we’ll confirm the next available pickup route.' };
  return { status: 'waitlist', label: 'Not on our route yet?', summary: 'We’re growing coverage. Share your contact details through booking or contact us to join the waitlist.' };
}
