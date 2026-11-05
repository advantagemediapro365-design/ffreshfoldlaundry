import type { APIRoute } from 'astro';
import { submitContactMessage, validateContactMessage } from '../../lib/wix';

export const POST: APIRoute = async ({ request }) => {
  const formData = await request.formData();
  const message = Object.fromEntries(formData.entries()) as Record<string, unknown>;
  const normalized = {
    ...message,
    fullName: message['full-name'],
    questionType: message['question-type'],
  };
  const validation = validateContactMessage(normalized);

  if (!validation.ok) {
    return new Response(JSON.stringify(validation), { status: 400, headers: { 'Content-Type': 'application/json' } });
  }

  const result = await submitContactMessage(normalized);
  const status = result.ok ? 200 : result.mode === 'unconfigured' ? 503 : 502;
  return new Response(JSON.stringify(result), { status, headers: { 'Content-Type': 'application/json' } });
};