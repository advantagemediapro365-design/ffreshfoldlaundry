import test from 'node:test';
import assert from 'node:assert/strict';
import { getZipAvailability } from './zipAvailability.js';

test('returns active service for Altoona-area ZIPs', () => {
  const result = getZipAvailability('16601');
  assert.equal(result.status, 'active');
  assert.match(result.summary, /Altoona/i);
});

test('returns weekly service for Lock Haven-area ZIPs', () => {
  const result = getZipAvailability('17745');
  assert.equal(result.status, 'weekly');
  assert.match(result.summary, /Lock Haven/i);
});

test('returns active service for State College ZIPs', () => {
  const result = getZipAvailability('16801');
  assert.equal(result.status, 'active');
  assert.match(result.summary, /State College/i);
});

test('sends P.O. Box and unsupported ZIPs to the physical-address or waitlist path', () => {
  assert.equal(getZipAvailability('16603').status, 'waitlist');
  assert.equal(getZipAvailability('99999').status, 'waitlist');
});

test('rejects invalid ZIP input', () => {
  const result = getZipAvailability('abc');
  assert.equal(result.status, 'invalid');
  assert.match(result.summary, /valid 5-digit ZIP code/i);
});
